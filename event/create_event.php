<?php
$pageTitle = 'Create Event';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_event_participation.php";
require_once "../db/dao_user.php";
require_once "../db/dao_club.php";
include_once "../model/event.php";
include_once "../model/event_participation.php";

$users = get_all_user_id_and_full_names();
$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$message = '';
$clubs = get_clubs_joined($username);

$post_name = '';
$post_des = '';
$post_club_id = '';
$post_start_date = '';
$post_end_date = '';
$post_uniform = '';
$post_notes = '';

// handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_name = $_POST['name'];
    $post_des = $_POST['des'];
    $post_club_id = $_POST['club_id'];
    $post_start_date = $_POST['start_date'];
    $post_end_date = $_POST['end_date'];
    $post_uniform = $_POST['uniform'];
    $post_notes = $_POST['notes'];

    if (empty($post_name) or
        empty($post_des) or
        empty($post_club_id) or
        empty($post_start_date) or
        empty($post_end_date) or
        empty($post_uniform) or
        empty($post_notes)
    ) {
        $message = 'Some fields are empty!';
    } elseif (strtotime($post_start_date > $post_end_date)) {
      $message = 'Start date cannot be after end date!';
    } else {
        $event = new Event(0, $post_club_id, $post_name, $post_des, $post_start_date, $post_end_date, $post_uniform, $post_notes);
        $event_id = add_event($event);

        if ($event_id <= 0) {
            $message = 'Event already exists!';
        } else {
            $event_participation = new EventParticipation(0, $user_id, $event_id, true);
            $event_participation_id = add_event_participation($event_participation);

            if ($event_participation_id <= 0) {
                $message = 'Event is created, but we cannot place you in the event! Please join manually.';
            } else {
                $message = 'Successfully added event!';
                header("Location: /event/event_view.php");
            }
        }
    }
}
?>

<div class="container mt-20">
  <h1 class="text-bold">Create a New Event</h1>
  <form action="create_event.php" method="post">
    <h5 class="fg-red"><?= $message ?></h5>
    <div class="form-group">
      <label for="name">Event Name</label>
      <input id="name" name="name" type="text" placeholder="Enter event name" value="<?= $post_name ?>">
    </div>
    <div class="form-group">
      <label for="des">Description</label>
      <br>
      <textarea id="des" type="text" name="des" placeholder="Enter Description"><?= $post_des ?></textarea>
    </div>
    <div class="form-group">
      <label for="club_id">Under which club?</label>
      <select id="club_id" name="club_id">
          <?php foreach ($clubs as $club): ?>
            <option value="<?= $club->getId() ?>"><?= $club->getName() ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="start_date">Start Date</label>
      <br>
      <input id="start_date" type="date" name="start_date" value="<?= $post_start_date ?>"/>
    </div>
    <div class="form-group">
      <label for="end_date">End Date</label>
      <br>
      <input id="end_date" type="date" name="end_date" value="<?= $post_end_date ?>"/>
    </div>
    <div class="form-group">
      <label for="uniform">Uniform</label>
      <br>
      <textarea id="uniform"
                type="text"
                name="uniform"
                placeholder="Enter a suitable uniform to wear during this event"><?= $post_uniform ?></textarea>
    </div>
    <div class="form-group">
      <label for="notes">Notes</label>
      <br>
      <textarea id="notes"
                type="text"
                name="notes"
                placeholder="Additional notes"><?= $post_notes ?></textarea>
    </div>
    <div class="form-group mt-10">
      <button class="button success">Create Event</button>
      <a class="button" href="/event/event_view.php">Go Back</a>
    </div>
  </form>
</div>
<?php include "../footer.php"; ?>

