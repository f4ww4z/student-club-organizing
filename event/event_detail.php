<?php
$pageTitle = 'View Events';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_event_participation.php";
require_once "../db/dao_user.php";

$event_id = $_GET['id'];
$user_id = get_user_id_from_username($_SESSION['username']);
$event = get_event($event_id);
$event_participation = get_event_participation($user_id, $event_id);
$participants = get_all_participants($event_id);
?>
<div class="container">
  <div class="mt-10 bg-light p-10">
    <div class="row">
      <h1 class="text-bold"><?= $event->getName() ?></h1>
    </div>
    <div class="row">
      <h4><?= $event->getDescription() ?></h4>
    </div>
    <div class="row">
      <div class="cell-sm-full cell-md-half d-flex flex-wrap flex-align-center">
        <img class="calendar-icon" src="../assets/img/calendar_icon.png" alt="calendar icon">
        <h4 class="text-bold ml-2">Start Date</h4>
        <div class="w-100"></div>
        <h4><?= date_format(date_create($event->getStartDate()), 'l, d F Y') ?></h4>
      </div>
      <div class="cell-sm-full cell-md-half d-flex flex-wrap flex-align-center">
        <img class="calendar-icon" src="../assets/img/calendar_icon.png" alt="calendar icon">
        <h4 class="text-bold ml-2">End Date</h4>
        <div class="w-100"></div>
        <h4><?= date_format(date_create($event->getEndDate()), 'l, d F Y') ?></h4>
      </div>
    </div>
    <div class="row">
      <div class="cell-sm-full cell-md-half">
        <h4 class="text-bold">Uniform</h4>
        <h6><?= $event->getUniform() ?></h6>
      </div>
      <div class="cell-sm-full cell-md-half">
        <h4 class="text-bold">Additional Notes</h4>
        <h6><?= $event->getNotes() ?></h6>
      </div>
    </div>
    <div class="row">
      <h5 class="text-bold">Participants:</h5>
        <?php if (sizeof($participants) <= 0) : ?>
          <h6>No participants yet.</h6>
        <?php else : ?>
          <table class="table row-border table-border">
            <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($participants as $index => $participant) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $participant ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      <table></table>
    </div>
    <div class="row">
      <a class="button secondary" href="event_view.php">Go Back</a>
        <?php if (is_null($event_participation)) : ?>
          <a class="ml-2 button primary"
             onclick="return confirm('Are you sure you want to join this event?')"
             href="/event/join_event.php?id=<?= $event->getId() ?>">
            Join
          </a>
        <?php else : ?>
          <a class="ml-2 button primary"
             onclick="return confirm('Are you sure you want to leave this event?')"
             href="/event/leave_event.php?id=<?= $event->getId() ?>">
            Leave Event
          </a>
            <?php if ($event_participation->canEdit()) : ?>
            <a class="button primary ml-3"
               href="update_event.php?id=<?= $event_id ?>">
              Edit
            </a>
            <a class="button alert"
               onclick="return confirm('Are you sure you want to delete this event and everyone that joined?')"
               href="/event/delete_event.php?id=<?= $event_id ?>">
              Delete
            </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
  </div>
</div>
<?php include "../footer.php"; ?>
