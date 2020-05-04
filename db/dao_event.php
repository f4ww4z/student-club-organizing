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

    $conn = get_connection();
    $stmt = $conn->prepare("INSERT INTO event (name, description, club_id)
                            VALUES (?, ?, ?)");
    $stmt->bind_param("ssi",
        $name,
        $description,
        $club_id);

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

    $conn = get_connection();
    $stmt = $conn->prepare("UPDATE event SET club_id=?, name=?, description=? where id=?");
    $stmt->bind_param("issi",
        $club_id,
        $name,
        $description,
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

function get_event(int $event_id): Event
{
    $conn = get_connection();

    $event = new Event($event_id, 0, '', '');

    $stmt = $conn->prepare(
        "SELECT club_id, name, description FROM event WHERE id = ?"
    );
    $stmt->bind_param("i", $event_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return $event;
    }

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $event->setClubId($row['club_id']);
        $event->setName($row['name']);
        $event->setDescription($row['description']);
    }

    return $event;
}
