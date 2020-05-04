<?php
$pageTitle = 'Delete Event';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../model/event.php";

$username = $_SESSION['username'];
$message = '';
$id = (int)$_GET['id'];
$events = delete_event($id);

if ($events <= 0) {
    $message = 'Delete failed';
    header("Location: /event/event_view.php");
} else {
    $message = 'Delete Successful';
    header("Location: /event/event_view.php");
}


