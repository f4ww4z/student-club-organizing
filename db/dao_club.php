<?php
require_once "mysql.php";
include "../model/club.php";

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