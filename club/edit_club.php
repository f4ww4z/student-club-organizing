<?php
$pageTitle = 'Edit Club';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";
require_once "../db/dao_user.php";

$club_id = (int)$_GET['id'];
$club = get_club($club_id);

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$user_can_edit = can_edit_club($user_id, $club_id);

$available_users = get_all_user_id_and_full_names();

if (!$user_can_edit) {
    header("Location: /club/club_detail.php?id=${club_id}");
}

$message = '';

// handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_club_name = $_POST['name'];
    $post_published_year = $_POST['year_founded'];
    $post_president_id = $_POST['president_id'];

    if (empty($post_club_name) or
        empty($post_published_year) or
        empty($post_president_id)) {
        $message = 'Please fill all fields!';
    } else {
        // all good, update club
        $club = new Club($club_id, $post_club_name, $post_published_year, $post_president_id);
        $affected_rows = update_club($club);
        if ($affected_rows <= 0) {
            $message = 'Cannot update club at this time. Please try again';
        } else {
            header("Location: /club/club_detail.php?id=${club_id}");
        }
    }
}

?>
<div class="container mt-10">
  <div style="background-color: #d7c7ff" class="d-flex flex-wrap p-10 tile">

    <h1 class="w-100 text-bold">Editing <span class="fg-darkIndigo"><?= $club->getName() ?></span></h1>
    <form action="edit_club.php?id=<?= $club_id ?>" method="post">
      <h5 class="fg-red"><?= $message ?></h5>
      <div class="form-group">
        <label for="name">Club Name</label>
        <input id="name"
               name="name"
               type="text"
               data-role="input"
               placeholder="Enter new club name"
               value="<?= $club->getName() ?>"/>
      </div>
      <div class="form-group">
        <label for="year_founded">Year Founded</label>
        <input id="year_founded"
               name="year_founded"
               type="number"
               placeholder="Enter year founded"
               value="<?= $club->getPublishYear() ?>"/>
      </div>
      <div class="form-group">
        <label for="president_id">President</label>
        <select name="president_id" id="president_id">
            <?php foreach ($available_users as $user_id => $username): ?>
              <option value="<?= $user_id ?>"
                  <?= $user_id === $club->getPresidentId() ? 'selected' : '' ?>>
                  <?= $username ?>
              </option>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group mt-10">
        <button class="button success">Update</button>
        <input type="reset" class="button" value="Reset">
      </div>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
