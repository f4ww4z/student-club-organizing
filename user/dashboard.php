<?php

$pageTitle = 'Dashboard';
include "../header.php";
include "../navbar.php";

$username = $_SESSION['username'];
?>
<div class="container mt-20">
  <h2>Welcome, <?= $username ?>!</h2>

  <div class="card image-header w-100 w-33-md">
    <div class="card-header fg-white"
         style="background-image: url('/assets/img/members icon.png')">
      Create Club
    </div>
    <div class="card-content p-2">
      Quisque eget vestibulum nulla. Quisque quis dui quis ex
      ultricies efficitur vitae non felis. Phasellus quis nibh
      hendrerit...
    </div>
    <div class="card-footer">
      <button class="button secondary">Read More</button>
    </div>
  </div>
</div>
<?php include "../footer.php"; ?>

