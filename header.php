<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <link rel="stylesheet" href="main.css">
  <title><?= "$pageTitle | Student Club Organizer" ?></title>
</head>
<body class="<?= isset($bodyClass) ? $bodyClass : '' ?>">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

