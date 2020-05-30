<?php
require_once "../db/dao_event_participation.php";
require_once "../db/dao_user.php";
include_once "../model/event_participation.php";
include "../header.php";

$user_id = get_user_id_from_username($_SESSION['username']);
$event_id = $_GET['id'];
$is_success = remove_event_participation($user_id, $event_id);

if ($is_success <= 0) {
    $_SESSION['message'] = 'Cannot leave event';
} else {
    $_SESSION['message'] = 'Successfully left the event.';
}

header("Location: /event/event_detail.php?id=$event_id");
