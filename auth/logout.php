<?php
include "../header.php";
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
header("Location: /auth/login.php");
