<?php
require_once "mysql.php";
include "../model/user.php";

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
