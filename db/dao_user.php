<?php
require_once "mysql.php";
include_once "../model/user.php";

function add_user(User $user): bool
{
    $conn = get_connection();

    $stmt = $conn->prepare("INSERT INTO user (username, full_name, email, password, contact_number, address) VALUES(?, ?, ?, ?, ?, ?)");
    $username = $user->getUsername();
    $full_name = $user->getFullName();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $contact_number = $user->getContactNumber();
    $address = $user->getAddress();
    $stmt->bind_param("ssssssi",
        $username,
        $full_name,
        $email,
        $password,
        $contact_number,
        $address,
    );

    return $stmt->execute();
}

function does_username_exist($username): bool
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT COUNT(username) AS row_count FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $res = $stmt->get_result();
    $res_data = $res->fetch_assoc();

    return $res_data['row_count'] > 0;
}

function does_user_exist($username, $password): bool
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT EXISTS(SELECT username, password FROM user WHERE username = ? AND password = ?) AS row_exist");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $res_data = $stmt->get_result()->fetch_assoc();

    return $res_data['row_exist'];
}

function get_all_user_id_and_full_names(): array
{
    $conn = get_connection();

    $result = mysqli_query($conn, "SELECT id, full_name FROM user");

    $users = array();

    while ($row = $result->fetch_assoc()) {
        $users[$row['id']] = $row['full_name'];
    }

    return $users;
}

function get_user_id_from_username($username): int
{
    $conn = get_connection();

    $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $is_success = $stmt->execute();
    if (!$is_success) {
        return 0;
    }

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['id'];
    } else {
        return 0;
    }
}