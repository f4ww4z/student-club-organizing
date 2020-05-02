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

$message = '';
// handle club delete
if (isset($_GET['op'])) {
    $operation = $_GET['op'];
    if ($operation === 'delete') {
        $affected_rows = delete_club($club_id);
        if ($affected_rows <= 0) {
            $message = 'Cannot delete club at this time.';
        } else {
            header('Location: club_view.php');
        }
    }
}

?>
<div class="container mt-10">
  <div style="background-color: #d7c7ff" class="d-flex flex-wrap p-10 tile">
      <?php if (!empty($message)): ?>
        <h4 class="w-100 text-bold mb-10"><?= $message ?></h4>
      <?php endif; ?>

    <h1 class="w-100 text-bold mb-10"><?= $club->getName() ?></h1>

    <h3 class="w-100">President: <b><?= $president->getFullName() ?></b> (<?= $president->getUsername() ?>)</h3>
    <h3 class="w-100">Year founded: <b><?= $club->getPublishYear() ?></b></h3>

    <a class="mt-2 button bg-red bg-darkRed-hover fg-white" href="edit_club.php?id=<?= $club_id ?>">
      <b>Edit</b>
    </a>
    <a href="club_detail.php?id=<?= $club_id ?>&op=delete"
       class="ml-2 mt-2 button bg-gray bg-darkRed-hover fg-white"
       onclick="return confirm('Are you sure you want to delete <?= $club->getName() ?> and ALL its events?')">
      <b>Delete</b>
    </a>
  </div>

  <!--  TODO: View all events of this club -->
</div>

<?php include "../footer.php"; ?>
