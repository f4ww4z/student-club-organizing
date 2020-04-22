<?php
$club_id_to_join = $_GET['id'];
$pageTitle = 'Join Club';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";

$club = get_club($club_id_to_join);

$username = $_SESSION['username'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $is_success = add_user_to_club($username, $club_id_to_join, false);
    if (!$is_success) {
        $message = 'Cannot join club, unexpected error.';
    } else {
        // successfully joined club, redirect user
        header("Location: /club/club_view.php");
    }
}
//TODO: add loading bar
//un join club
?>
<div class="container">
  <h1 class="text-bold">Joining Club <i class="fg-darkIndigo"><?= $club->getName() ?></i>...</h1>
  <h3 class="fg-red"><?= $message ?></h3>
  <form action="#" method="post">
    <div class="form-control">
      <p>Are you sure you want to join club <b><?= $club->getName() ?></b>?</p>
    </div>
    <div class="form-group mt-10">
      <button class="button success">Join Club</button>
      <a class="button" href="/club/club_view.php">Go Back</a>
    </div>
  </form>
</div>
<?php include "../footer.php"; ?>
