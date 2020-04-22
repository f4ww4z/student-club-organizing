<?php
require_once "mysql.php";
include "../model/club.php";
require_once "dao_user.php";

function get_clubs_joined(string $username): array
{
    $conn = get_connection();

    $stmt = $conn->prepare(
        "SELECT club.id, club.name, club.publish_year, club.president_id FROM club
        INNER JOIN club_members cm 
            ON club.id = cm.club_id
        INNER JOIN user u 
            ON cm.user_id = u.id
        WHERE u.username = ?");
    $stmt->bind_param("s", $username);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return array();
    }

    $result = $stmt->get_result();

    $clubs = array();

    while ($row = $result->fetch_assoc()) {
        $club = new Club(
            $row['id'],
            $row['name'],
            $row['publish_year'],
            $row['president_id'],
        );
        array_push($clubs, $club);
    }

    return $clubs;
}

/**
 * @param Club $club
 * @return int the new club's id, -1 if error
 */
function add_club(Club $club): int
{
    $club_name = $club->getName();
    $publish_year = $club->getPublishYear();
    $president_id = $club->getPresidentId();

    $conn = get_connection();
    $stmt = $conn->prepare("INSERT INTO club (name, publish_year, president_id)
                            VALUES (?, ?, ?)");
    $stmt->bind_param("sii",
        $club_name,
        $publish_year,
        $president_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_insert_id($conn);
}

function add_user_to_club($username, $club_id, $can_edit = true): bool
{
    $conn = get_connection();

    $user_id = get_user_id_from_username($username);

    $stmt = $conn->prepare("INSERT INTO club_members (user_id, club_id, join_date, can_edit)
                            VALUES (?, ?, ?, ?)");

    $date_now = date('Y-m-d');

    $can_edit = (int)$can_edit;

    $stmt->bind_param("iisi", $user_id, $club_id, $date_now, $can_edit);

    return $stmt->execute();
}