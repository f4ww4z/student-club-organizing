<?php
require_once "mysql.php";
include_once "../model/club.php";
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

function add_user_to_club(string $username, int $club_id, bool $can_edit = true): bool
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

function remove_user_from_club(string $username, int $club_id): bool
{
    $conn = get_connection();

    $user_id = get_user_id_from_username($username);

    $stmt = $conn->prepare("DELETE FROM club_members WHERE user_id = ? AND club_id = ?");

    $stmt->bind_param("ii", $user_id, $club_id);

    return $stmt->execute();
}

function get_club(int $club_id): Club
{
    $conn = get_connection();

    $club = new Club(0, '', 0, 0);

    $stmt = $conn->prepare("SELECT name, publish_year, president_id FROM club
                            WHERE id = ?");
    $stmt->bind_param("i", $club_id);
    $is_success = $stmt->execute();
    if (!$is_success) {
        return $club;
    }

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $club->setName($row['name']);
        $club->setPublishYear($row['publish_year']);
        $club->setPresidentId($row['president_id']);

        return $club;
    } else {
        return $club;
    }
}

function get_all_clubs(): array
{
    $clubs = array();

    $conn = get_connection();
    $stmt = $conn->prepare("SELECT club.id, name, publish_year, president_id, u.full_name FROM club
                            INNER JOIN user u on club.president_id = u.id");
    $is_success = $stmt->execute();

    if (!$is_success) {
        return $clubs;
    }
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $club = new ClubWithPresident(
            $row['id'],
            $row['name'],
            $row['publish_year'],
            $row['president_id'],
            $row['full_name'],
        );

        array_push($clubs, $club);
    }

    return $clubs;
}

function can_edit_club(int $user_id, int $club_id): bool
{
    $can_edit = false;

    $conn = get_connection();

    // enable the president to be able to edit the club
    $club = get_club($club_id);
    if ($user_id === $club->getPresidentId()) {
        $stmt = $conn->prepare("UPDATE club_members SET can_edit = TRUE WHERE user_id = ? AND club_id = ?");
        $stmt->bind_param("ii", $user_id, $club_id);

        $stmt->execute();

        return true;
    }

    $stmt = $conn->prepare("SELECT can_edit FROM club_members WHERE user_id = ? AND club_id = ?");
    $stmt->bind_param("ii", $user_id, $club_id);
    $is_success = $stmt->execute();

    if (!$is_success) {
        return $can_edit;
    }
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $can_edit = (bool)$row['can_edit'];
    }

    return $can_edit;
}

function update_club(Club $club): int
{
    $club_id = $club->getId();
    $club_name = $club->getName();
    $publish_year = $club->getPublishYear();
    $president_id = $club->getPresidentId();

    $conn = get_connection();

    $stmt = $conn->prepare("UPDATE club SET name = ?, publish_year = ?, president_id = ?
                            WHERE id = ?");
    $stmt->bind_param("siii",
        $club_name,
        $publish_year,
        $president_id,
        $club_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_affected_rows($conn);
}


function delete_club(int $club_id): int
{
    $conn = get_connection();
    $stmt = $conn->prepare("DELETE FROM club WHERE id = ?");
    $stmt->bind_param("i", $club_id);

    $is_success = $stmt->execute();
    if (!$is_success) {
        return -1;
    }

    return mysqli_affected_rows($conn);
}