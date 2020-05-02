<?php
$pageTitle = 'My Clubs';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_club.php";

$username = $_SESSION['username'];
$clubs_joined = get_clubs_joined($username);

$club_joined_ids = array_map(
    function (Club $club) {
        return $club->getId();
    },
    $clubs_joined
);

$all_clubs = get_all_clubs();
?>
<div class="d-flex flex-wrap flex-justify-center container">
  <h1 class="w-100 text-bold">My Clubs</h1>

  <div class="d-flex flex-wrap flex-justify-center w-100 bg-light">
      <?php foreach ($clubs_joined as $club): ?>
        <a href="club_detail.php?id=<?= $club->getId() ?>"
           class="d-flex flex-justify-center flex-align-center p-2 m-3 no-decor fg-black tile club-tile">
          <h4 class="text-bold text-center"><?= $club->getName() ?></h4>
        </a>
      <?php endforeach; ?>
  </div>

  <div class="d-flex flex-justify-end w-100 mt-4">
<!--    <a class="button fg-white bg-lightIndigo bg-indigo-hover text-bold"-->
<!--       href="/club/create_club.php">-->
<!--    </a>-->
    <a class="button fg-white bg-lightIndigo bg-indigo-hover text-bold"
       href="/club/create_club.php">
      Create New Club
    </a>
  </div>

  <h1 class="w-100 text-bold">All Clubs</h1>
  <table class="w-100 table striped"
         data-role="table"
         data-horizontal-scroll="true">
    <thead>
    <tr>
      <th class="sortable-column" data-sortable="true" data-format="int" data-sort-dir="asc">Code</th>
      <th class="sortable-column" data-sortable="true">Club Name</th>
      <th class="sortable-column" data-sortable="true" data-format="int">Year Founded</th>
      <th class="sortable-column" data-sortable="true">President</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($all_clubs as $club): ?>
      <tr>
        <td><?= $club->getId() ?></td>
        <td><?= $club->getName() ?></td>
        <td><?= $club->getPublishYear() ?></td>
        <td><?= $club->getPresidentFullName() ?></td>
        <td>
          <!-- Only show join button on clubs that user hasn't joined yet -->
            <?php if (!in_array($club->getId(), $club_joined_ids)): ?>
              <a class="button success"
                 href="/club/join_club.php?id=<?= $club->getId() ?>">
                Join
              </a>
            <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include "../footer.php"; ?>
