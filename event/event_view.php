<?php
$pageTitle = 'View Events';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_event_participation.php";

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$event_parts_with_detail = get_all_events_of_participant($user_id);
$events_not_joined = get_all_events_not_joined_by_participant($user_id);
?>
  <div class="container mt-10">
    <div class="row">
      <div class="cell-md-full cell-lg-one-third d-flex flex-column">
        <h2 class="w-100 text-bold">Events I'm Joining</h2>
          <?php foreach ($event_parts_with_detail as $e): ?>
            <div class="p-8 mt-4 d-flex flex-wrap flex-justify-between tile"
                 style="background-color: #d7c7ff">
              <h3 class="m-0 text-bold"><?= $e->getEvent()->getName() ?></h3>
              <h6 class="m-0 mt-2-lg text-bold fg-darkGray"><?= $e->getClubName() ?></h6>

              <div class="w-100"></div>
              <h5><?= $e->getEvent()->getDescription() ?></h5>

              <div class="w-100"></div>
              <p>&nbsp;</p>
              <div class="d-flex flex-justify-end">
                <a class="button mr-2 bg-indigo bg-darkIndigo-hover fg-white"
                   href="/event/event_detail.php?id=<?= $e->getEvent()->getId() ?>">
                  View
                </a>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
      <div class="cell-md-full cell-lg-two-third pl-5-md pl-0 d-flex flex-column">
        <h2 class="text-bold w-100">All Events</h2>

          <?php foreach ($events_not_joined as $e): ?>
            <div class="p-8 mt-4 d-flex flex-wrap flex-justify-between tile"
                 style="background-color: #eee0ff">
              <h3 class="m-0 text-bold"><?= $e->getEventName() ?></h3>
              <h6 class="m-0 text-bold fg-darkGray"><?= $e->getClubName() ?></h6>

              <div class="w-100"></div>
              <h5><?= $e->getEventDesc() ?></h5>

              <div class="w-100"></div>
              <p>&nbsp;</p>
              <div class="d-flex flex-justify-end">
                <a class="button mr-2 bg-indigo bg-darkIndigo-hover fg-white"
                   href="/event/event_detail.php?id=<?= $e->getId() ?>">
                  View
                </a>
                <a class="button"
                   onclick="return confirm('Are you sure you want to join this event?')"
                   href="/event/join_event.php?id=<?= $e->getId() ?>">
                  Join
                </a>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
    </div>

    <div class="d-flex flex-justify-between w-100 mt-4">
      <a class="button fg-white bg-lightIndigo bg-indigo-hover text-bold"
         href="/event/create_event.php">
        Create New Event
      </a>
    </div>
  </div>
<?php include "../footer.php"; ?>