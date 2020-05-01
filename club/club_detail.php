<?php
$pageTitle = 'View Club';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";
require_once "../db/dao_user.php";

$club_id = (int)$_GET['id'];

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$user_can_edit = can_edit_club($user_id, $club_id);

$club = get_club($club_id);

$president = get_user($club->getPresidentId());
?>
<div class="container mt-10">
  <div style="background-color: #d7c7ff" class="d-flex flex-wrap p-10 tile">
    <h1 class="w-100 text-bold mb-10"><?= $club->getName() ?></h1>

    <h3 class="w-100">President: <b><?= $president->getFullName() ?></b> (<?= $president->getUsername() ?>)</h3>
    <h3 class="w-100">Year founded: <b><?= $club->getPublishYear() ?></b></h3>

    <a class="mt-2 button bg-red bg-darkRed-hover fg-white" href="edit_club.php?id=<?= $club_id ?>">
      <b>Edit</b>
    </a>
  </div>

  <!--  TODO: View all events of this club -->
</div>

<?php include "../footer.php"; ?>
