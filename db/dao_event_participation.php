<?php
require_once "mysql.php";
include_once "../model/event_participation.php";
include_once "../model/event.php";

function get_all_events_of_participant(int $user_id): array
{
    $event_parts_with_detail = array();

    $conn = get_connection();
    $stmt = $conn->prepare("SELECT ep.id as ep_id, ep.user_id, ep.event_id, ep.can_edit, e.club_id, e.name as event_name, e.description as event_desc, c.name as club_name
            FROM event_participation ep
            INNER JOIN event e on ep.event_id = e.id
            INNER JOIN club c on e.club_id = c.id
                WHERE ep.user_id = ?");
    $stmt->bind_param("i", $user_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return $event_parts_with_detail;
    }

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $event = new Event(
            $row['event_id'],
            $row['club_id'],
            $row['event_name'],
            $row['event_desc']
        );

        $event_part = new EventParticipation(
            $row['ep_id'],
            $row['user_id'],
            $row['event_id'],
            (bool)$row['can_edit']
        );

        $club_name = $row['club_name'];

        $ep_with_detail = new EventParticipationAndDetail($event, $event_part, $club_name);

        array_push($event_parts_with_detail, $ep_with_detail);
    }

    return $event_parts_with_detail;
}

function add_event_participation(EventParticipation $ep): int
{
    $conn = get_connection();
    $user_id = $ep->getUserId();
    $event_id = $ep->getEventId();
    $can_edit = (int)$ep->canEdit();

    $stmt = $conn->prepare("INSERT INTO event_participation (user_id, event_id, can_edit) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $event_id, $can_edit);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_insert_id($conn);
}