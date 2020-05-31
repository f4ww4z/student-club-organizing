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

$club_members = get_club_members($club_id);

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
    } elseif ($operation === 'leave') {
        $is_success = remove_user_from_club($username, $club_id);

        if ($is_success) {
            $_SESSION['message'] = 'Successfully left the club!';
            header('Location: club_view.php');
        } else {
            $message = 'Cannot leave club at this time.';
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
    <h3 class="w-100">Club members:</h3>
      <?php if (sizeof($club_members) <= 0) : ?>
        <h6>No club members yet.</h6>
      <?php else : ?>
        <table class="w-100 bg-light table row-border table-border">
          <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($club_members as $index => $full_name) : ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $full_name ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    <div class="w-100"></div>
    <a class="button mb-2" onclick="window.print()">Save as PDF</a>
    <div class="w-100"></div>
      <?php if ($user_can_edit) : ?>
        <a class="mt-2 button bg-red bg-darkRed-hover fg-white" href="edit_club.php?id=<?= $club_id ?>">
          <b>Edit</b>
        </a>
        <a href="club_detail.php?id=<?= $club_id ?>&op=delete"
           class="ml-2 mt-2 button bg-gray bg-darkRed-hover fg-white"
           onclick="return confirm('Are you sure you want to delete <?= $club->getName() ?> and ALL its events?')">
          <b>Delete</b>
        </a>
      <?php endif; ?>
    <a href="club_detail.php?id=<?= $club_id ?>&op=leave"
       class="ml-2 mt-2 button primary fg-white"
       onclick="return confirm('Are you sure you want to leave club <?= $club->getName() ?>?')">
      <b>Leave</b>
    </a>
  </div>
</div>

<?php include "../footer.php"; ?>
