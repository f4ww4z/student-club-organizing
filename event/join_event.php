<?php
require_once "../db/dao_event_participation.php";
require_once "../db/dao_user.php";
include_once "../model/event_participation.php";
include "../header.php";

$user_id = get_user_id_from_username($_SESSION['username']);
$event_id = $_GET['id'];
$ep = new EventParticipation(0, $user_id, $event_id, false);
$ep_id = add_event_participation($ep);

if ($ep_id <= 0) {
    $_SESSION['message'] = 'Cannot join event';
} else {
    $_SESSION['message'] = 'Successfully joined event!';
}

header("Location: /event/event_detail.php?id=$event_id");
