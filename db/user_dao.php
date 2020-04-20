<?php
require_once "mysql.php";
include "../model/user.php";

function add_user(User $user): bool
{
    $conn = get_connection();

    $stmt = $conn->prepare("INSERT INTO user (username, full_name, email, password, contact_number, address, type_of_user) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $username = $user->getUsername();
    $full_name = $user->getFullName();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $contact_number = $user->getContactNumber();
    $address = $user->getAddress();
    $type_of_user = $user->getTypeOfUser();
    $stmt->bind_param("ssssssi",
        $username,
        $full_name,
        $email,
        $password,
        $contact_number,
        $address,
        $type_of_user
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


