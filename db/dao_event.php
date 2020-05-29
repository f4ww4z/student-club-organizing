<?php
require_once "mysql.php";
include "../model/event.php";
require_once "dao_user.php";


/**
 * @param Event $event
 * @return int the new club's id, -1 if error
 */
function add_event(Event $event): int
{
    $club_id = $event->getClubId();
    $name = $event->getName();
    $description = $event->getDescription();
    $start_date = $event->getStartDate();
    $end_date = $event->getEndDate();
    $uniform = $event->getUniform();
    $notes = $event->getNotes();

    $conn = get_connection();
    $stmt = $conn->prepare("INSERT INTO event (club_id, name, description, start_date, end_date, uniform, notes)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss",
        $club_id,
        $name,
        $description,
        $start_date,
        $end_date,
        $uniform,
        $notes);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_insert_id($conn);
}

function update_event(Event $event): int
{
    $id = $event->getId();
    $club_id = $event->getClubId();
    $name = $event->getName();
    $description = $event->getDescription();
    $start_date = $event->getStartDate();
    $end_date = $event->getEndDate();
    $uniform = $event->getUniform();
    $notes = $event->getNotes();

    $conn = get_connection();
    $stmt = $conn->prepare("UPDATE event SET club_id=?, name=?, description=?, start_date=?, end_date=?, uniform=?, notes=? where id=?");
    $stmt->bind_param("issssssi",
        $club_id,
        $name,
        $description,
        $start_date,
        $end_date,
        $uniform,
        $notes,
        $id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_affected_rows($conn);
}

function delete_event(int $id): int
{
    $conn = get_connection();
    $stmt = $conn->prepare("DELETE from event WHERE id= $id");
    $stmt->bind_param("i",
        $id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return $is_success;
}

//function get_all_events_of_user(string $username): array
//{
//    $conn = get_connection();
//
//    $events = array();
//
//    $stmt = $conn->prepare(
//        "SELECT event.id, event.club_id,event.name, event.description FROM event
//        INNER JOIN club_members cm
//            ON event.club_id = cm.club_id
//        INNER JOIN user u
//            ON cm.user_id = u.id
//        WHERE u.username = ?");
//    $stmt->bind_param("s", $username);
//
//    $is_success = $stmt->execute();
//    if (!$is_success) {
//        return $events;
//    }
//
//    $result = $stmt->get_result();
//
//    while ($row = $result->fetch_assoc()) {
//        $event = new Event(
//            $row['id'],
//            $row['club_id'],
//            $row['name'],
//            $row['description']
//        );
//        array_push($events, $event);
//    }
//
//    return $events;
//}

function get_event(int $event_id): ?Event
{
    $conn = get_connection();

    $stmt = $conn->prepare(
        "SELECT * FROM event WHERE id = ?"
    );
    $stmt->bind_param("i", $event_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return null;
    }

    $result = $stmt->get_result();

    $event = null;

    if ($row = $result->fetch_assoc()) {
        $event = new Event(
            $event_id,
            $row['club_id'],
            $row['name'],
            $row['description'],
            $row['start_date'],
            $row['end_date'],
            $row['uniform'],
            $row['notes']
        );
    }

    return $event;
}
