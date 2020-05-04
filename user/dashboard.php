<?php

$pageTitle = 'Dashboard';
include "../header.php";
include "../navbar.php";

$username = $_SESSION['username'];
?>
<div class="d-flex flex-wrap container mt-10">
  <h3 class="w-100">Welcome, <?= $username ?>!</h3>

  <div class="w-100 w-50-md">
    <h1>Events Joined</h1>
  </div>

  <div class="w-100 w-50-md">
    <h1>Clubs Joined</h1>
  </div>
</div>
<?php include "../footer.php"; ?>

