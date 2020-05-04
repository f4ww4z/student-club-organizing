<?php
$pageTitle = 'Edit an Event';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_event.php";
require_once "../db/dao_club.php";

$username = $_SESSION['username'];
$id = $_GET['id'];
$event = get_event($id);
$club_of_event = get_club($event->getClubId());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_name = $_POST['name'];
    $post_desc = $_POST['des'];

    if (empty($post_name) or
        empty($post_desc)
    ) {
        $message = 'Some fields are empty!';
    } else {
        $event->setName($post_name);
        $event->setDescription($post_desc);

        $affected_rows = update_event($event);

        if ($affected_rows <= 0) {
            $message = 'Event cannot be updated.';
        } else {
            $message = 'Successfully updated event!';
            header("Location: /event/event_view.php");
        }
    }
}
?>
  <div class="d-flex flex-wrap flex-justify-center container mt-10">
    <h1 class="w-100 text-bold">Editing Event...</h1>

    <div class="d-flex flex-wrap flex-justify-center w-100 bg-light">
      <form action="#" method="post">
        <table class="table">
          <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Club Name</th>
          </tr>
          <tr>
            <td><input type="text" name="name" value="<?= $event->getName() ?>"/></td>
            <td><input type="text" name="des" value="<?= $event->getDescription() ?>"/></td>
            <td><?= $club_of_event->getName() ?></td>
          </tr>

        </table>
        <div class="d-flex flex-justify-between w-100 mt-4">
          <a class="button" href="/event/event_view.php">Go Back</a>
          <button type="submit" class="button success">Update</button>
        </div>
      </form>
    </div>

  </div>
<?php include "../footer.php"; ?>