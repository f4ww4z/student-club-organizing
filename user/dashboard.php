<?php

$pageTitle = 'Dashboard';
include "../header.php";
include "../navbar.php";

$username = $_SESSION['username'];
?>
<div class="container mt-20">
  <h2>Welcome, <?= $username ?>!</h2>
</div>
<?php include "../footer.php"; ?>

