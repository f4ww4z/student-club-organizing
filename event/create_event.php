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

// handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_name = $_POST['name'];
    $post_des = $_POST['des'];
    $post_club_id = $_POST['club_id'];

    if (empty($post_name) or
        empty($post_des) or
        empty($post_club_id)
    ) {
        $message = 'Some fields are empty!';
    } else {
        $event = new Event(0, $post_club_id, $post_name, $post_des);
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
      <input id="name" name="name" type="text" placeholder="Enter event name">
    </div>
    <div class="form-group">
      <label for="des">Description</label>
      <br>
      <textarea id="des" type="text" name="des" placeholder="Enter Description" class="des"></textarea>
    </div>
    <div class="form-group">
      <label for="club_id">Under which club?</label>
      <select id="club_id" name="club_id">
          <?php foreach ($clubs as $club): ?>
            <option value="<?= $club->getId() ?>"><?= $club->getName() ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group mt-10">
      <button class="button success">Create Event</button>
      <a class="button" href="/event/event_view.php">Go Back</a>
    </div>
  </form>
</div>
<?php include "../footer.php"; ?>

