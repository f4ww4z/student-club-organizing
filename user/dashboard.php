<?php

$pageTitle = 'Dashboard';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";
require_once "../db/dao_user.php";
require_once "../db/dao_event_participation.php";

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);

$clubs_joined = get_clubs_joined($username);
$events_joined = get_all_events_of_participant($user_id);
?>
<div class="container mt-10">
  <div class="row">
    <h3 class="w-100 hide-printing">Welcome, <?= $username ?>!</h3>
  </div>
  <div class="row">
    <div class="cell-md-full cell-lg-two-third pr-0 pr-16-lg">
      <h1>Events Joined</h1>

      <table class="w-100 table striped"
             data-role="table"
             data-horizontal-scroll="true">
        <thead>
        <tr>
          <th class="sortable-column" data-sortable="true" data-format="int" data-sort-dir="asc">Code</th>
          <th class="sortable-column" data-sortable="true">Event Name</th>
          <th class="sortable-column" data-sortable="true">Club</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events_joined as $event): ?>
            <?php $start_date = $event->getEvent()->getStartDate(); ?>
          <tr>
            <td><?= $event->getEvent()->getId() ?></td>
            <td><?= $event->getEvent()->getName() ?></td>
            <td><?= $event->getClubName() ?></td>
            <td>
              <a class="button mr-2 bg-indigo bg-darkIndigo-hover fg-white"
                 href="/event/event_detail.php?id=<?= $event->getEvent()->getId() ?>">
                View
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="cell-md-full cell-lg-one-third">
      <h1 class="w-100 mb-4">Clubs Joined</h1>
      <div class="d-flex flex-wrap flex-align-start">
          <?php foreach ($clubs_joined as $event) : ?>
            <a
                href="/club/club_detail.php?id=<?= $event->getId() ?>"
                class="m-1 p-2 d-flex flex-align-center flex-justify-center bg-lightAmber bg-amber-hover fg-dark club-name-dashboard"
                style="width: 120px; height: 120px; border-radius: 20%;">
                <?= $event->getName() ?>
            </a>
          <?php endforeach; ?>

      </div>
    </div>
  </div>
  <div class="row flex-justify-center">
    <a class="button mb-2" onclick="window.print()">Save Page as PDF</a>
  </div>

  <script src="/assets/js/textFit.min.js"></script>
  <script>
      textFit(document.getElementsByClassName("club-name-dashboard"),
          {
              alignHoriz: true,
              alignVert: true,
              multiLine: true,
          })
  </script>
</div>
<?php include "../footer.php"; ?>

