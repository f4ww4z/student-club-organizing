<?php
$pageTitle = 'View Events';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_event_participation.php";

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$event_parts_with_detail = get_all_events_of_participant($user_id);
?>
  <div class="d-flex flex-wrap flex-justify-center container mt-10">
    <h1 class="w-100 text-bold">My Events</h1>

    <div class="d-flex flex-column w-100">
        <?php foreach ($event_parts_with_detail as $ep): ?>
          <div class="p-8 mt-4 d-flex flex-wrap flex-justify-between tile"
               style="background-color: #d7c7ff">
            <h3 class="m-0 text-bold"><?= $ep->getEvent()->getName() ?></h3>
            <h6 class="m-0 text-bold fg-darkGray"><?= $ep->getClubName() ?></h6>

            <div class="w-100"></div>
            <h5><?= $ep->getEvent()->getDescription() ?></h5>

              <?php if ($ep->getEventParticipation()->canEdit()): ?>
                <div class="w-100"></div>
                <p>&nbsp;</p>
                <div class="d-flex flex-justify-end">
                  <a class="button mr-2 bg-indigo bg-darkIndigo-hover fg-white"
                     href="/event/update_event.php?id=<?= $ep->getEvent()->getId() ?>">
                    Update
                  </a>
                  <a class="button"
                     onclick="return confirm('Are you sure you want to delete this event and everyone that joined?')"
                     href="/event/delete_event.php?id=<?= $ep->getEvent()->getId() ?>">
                    Delete
                  </a>
                </div>
              <?php endif; ?>
          </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex flex-justify-between w-100 mt-4">
      <a class="button fg-white bg-lightIndigo bg-indigo-hover text-bold"
         href="/event/create_event.php">
        Create New Event
      </a>
    </div>
  </div>
<?php include "../footer.php"; ?>