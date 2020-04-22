<?php
$pageTitle = 'My Clubs';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";

$username = $_SESSION['username'];
$clubs = get_clubs_joined($username);

?>
<div class="d-flex flex-wrap flex-justify-center container mt-20">
  <h1 class="w-100 text-bold">My Clubs</h1>

  <div class="d-flex flex-wrap flex-justify-center w-100 bg-light">
      <?php foreach ($clubs as $club): ?>
        <a href="club_view.php"
           class="d-flex flex-justify-center flex-align-center p-2 m-3 no-decor fg-black tile club-tile">
          <h4 class="text-bold text-center"><?= $club->getName() ?></h4>
        </a>
      <?php endforeach; ?>
  </div>

  <div class="d-flex flex-justify-between w-100 mt-4">
    <a class="button fg-white bg-indigo text-bold"
       href="/club/create_club.php">
      TODO
    </a>
    <a class="button fg-white bg-lightIndigo bg-indigo-hover text-bold"
       href="/club/create_club.php">
      Create New Club
    </a>
  </div>
</div>
<?php include "../footer.php"; ?>
