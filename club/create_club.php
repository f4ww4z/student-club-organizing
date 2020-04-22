<?php
$pageTitle = 'Register Club';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_user.php";
require_once "../db/dao_club.php";
require_once "../model/club.php";

$users = get_all_user_id_and_full_names();
$username = $_SESSION['username'];
$message = '';

// handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_name = $_POST['name'];
    $post_publish_year = $_POST['publish_year'];
    $post_president_id = $_POST['president_id'];

    if (empty($post_name) or
        empty($post_publish_year) or
        empty($post_president_id)
    ) {
        $message = 'Some fields are empty!';
    } else {
        $club = new Club(0, $post_name, $post_publish_year, $post_president_id);

        $club_id = add_club($club);

        if ($club_id <= 0) {
            $message = 'Club already exists!';
        } else {
            $message = 'Successfully added club!';

            // success, add user as a club member
            $is_success = add_user_to_club($username, $club_id);
            if (!$is_success) {
                $message = 'Cannot add user to club!';
            } else {
                // success, redirect user to view
                header("Location: /club/club_view.php");
            }
        }
    }
}
?>
<div class="container mt-20">
  <h1 class="text-bold">Register a New Club</h1>
  <form action="create_club.php" method="post">
    <h5 class="fg-red"><?= $message ?></h5>
    <div class="form-group">
      <label for="name">Club Name</label>
      <input id="name" name="name" type="text" placeholder="Enter club name">
    </div>
    <div class="form-group">
      <label for="publish_year">Year Founded</label>
      <br>
      <input id="publish_year" name="publish_year" type="number" placeholder="2020">
    </div>
    <div class="form-group">
      <label for="president_id">President (must be an active user)</label>
      <select id="president_id" name="president_id">
          <?php foreach ($users as $user_id => $full_name): ?>
            <option value="<?= $user_id ?>"><?= $full_name ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group mt-10">
      <button class="button success">Register Club</button>
      <a class="button" href="/club/club_view.php">Go Back</a>
    </div>
  </form>
</div>
<?php include "../footer.php"; ?>
