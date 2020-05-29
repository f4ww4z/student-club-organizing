<?php
$pageTitle = 'Edit an Event';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_club.php";

$message = '';
$username = $_SESSION['username'];
$id = $_GET['id'];
$event = get_event($id);
$clubs = get_clubs_joined($username);

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
        $message = 'Some fields were empty!';
    } elseif (strtotime($post_start_date > $post_end_date)) {
        $message = 'Start date cannot be after end date!';
    } else {
        $event->setName($post_name);
        $event->setDescription($post_des);
        $event->setClubId($post_club_id);
        $event->setStartDate($post_start_date);
        $event->setEndDate($post_end_date);
        $event->setUniform($post_uniform);
        $event->setNotes($post_notes);

        $affected_rows = update_event($event);

        if ($affected_rows <= 0) {
            $message = 'Event cannot be updated.';
        } else {
            $message = 'Successfully updated event!';
            header("Location: /event/event_detail.php?id=" . $id);
        }
    }
}
?>
  <div class="container mt-20">
    <h1 class="text-bold">Editing event...</h1>
    <form action="#" method="post">
      <h5 class="fg-red"><?= $message ?></h5>
      <div class="form-group">
        <label for="name">Event Name</label>
        <input id="name" name="name" type="text" placeholder="Enter event name" value="<?= $event->getName() ?>">
      </div>
      <div class="form-group">
        <label for="des">Description</label>
        <br>
        <textarea id="des" type="text" name="des"
                  placeholder="Enter Description"><?= $event->getDescription() ?></textarea>
      </div>
      <div class="form-group">
        <label for="club_id">Under which club?</label>
        <select id="club_id" name="club_id">
            <?php foreach ($clubs as $club): ?>
              <option value="<?= $club->getId() ?>"
                      <?php if ($club->getId() == $event->getClubId()): ?>selected<?php endif; ?>><?= $club->getName() ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="start_date">Start Date</label>
        <br>
        <input id="start_date" type="date" name="start_date" value="<?= $event->getStartDate() ?>"/>
      </div>
      <div class="form-group">
        <label for="end_date">End Date</label>
        <br>
        <input id="end_date" type="date" name="end_date" value="<?= $event->getEndDate() ?>"/>
      </div>
      <div class="form-group">
        <label for="uniform">Uniform</label>
        <br>
        <textarea id="uniform"
                  type="text"
                  name="uniform"
                  placeholder="Enter a suitable uniform to wear during this event"><?= $event->getUniform() ?></textarea>
      </div>
      <div class="form-group">
        <label for="notes">Notes</label>
        <br>
        <textarea id="notes"
                  type="text"
                  name="notes"
                  placeholder="Additional notes"><?= $event->getNotes() ?></textarea>
      </div>
      <div class="form-group mt-10">
        <button class="button success">Update Event</button>
        <a class="button" href="/event/event_detail.php?id=<?= $id ?>">Go Back</a>
      </div>
    </form>
  </div>
<?php include "../footer.php"; ?>