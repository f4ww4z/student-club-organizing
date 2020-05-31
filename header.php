<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <link rel="stylesheet" href="/main.css">
  <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
  <title><?= "$pageTitle | Student Club Organizer" ?></title>
</head>
<body class="<?= isset($bodyClass) ? $bodyClass : '' ?> pt-12 pb-12">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if user is not logged in, should be taken back
$unauthenticated_page_titles = [
    'Login',
    'Register',
    'Home',
    'Logout'
];

$is_authenticated = (session_status() == PHP_SESSION_ACTIVE and !empty($_SESSION['username']));

if (!in_array($pageTitle, $unauthenticated_page_titles) and !$is_authenticated) {
    header("Location: /auth/logout.php");
}
?>
<!--Show any message stored in session and destroys it immediately afterwards -->
<?php if (isset($_SESSION['message'])) : ?>
  <script type="application/javascript">
      alert("<?=$_SESSION['message'] ?>");
  </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>
