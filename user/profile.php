<?php
$pageTitle = 'My Profile';
include "../header.php";
include "../navbar.php";
require_once "../db/dao_user.php";

$username = $_SESSION['username'];
$user_id = get_user_id_from_username($username);
$user = get_user($user_id);

$message = '';

// handle POST (update user) request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_username = $_POST['username'];
    $post_full_name = $_POST['full_name'];
    $post_email = $_POST['email'];
    $post_contact_number = $_POST['contact_number'];
    $post_address = $_POST['address'];

    if (empty($post_username) or
        empty($post_full_name) or
        empty($post_email) or
        empty($post_contact_number) or
        empty($post_address)
    ) {
        $message = 'Some fields were empty!';
    } elseif (does_username_exist($post_username) and $post_username !== $username) {
        $message = 'Username already exists';
    } else {
        // all good, update db
        $user->setUsername($post_username);
        $user->setFullName($post_full_name);
        $user->setEmail($post_email);
        $user->setContactNumber($post_contact_number);
        $user->setAddress($post_address);

        $affected_rows = update_user($user);
        if ($affected_rows < 0) {
            $message = 'Cannot update user at this time. Please try again.';
        } else {
            $message = 'Successfully updated!';
        }
    }
}

// handle user delete
if (isset($_GET['op']) and $_GET['op'] === 'delete') {
    $affected_rows = delete_user($user_id);

    if ($affected_rows <= 0) {
        $message = 'Cannot delete your account at this time. Ensure that you are not a president of any club.';
    } else {
        $message = 'Successfully removed account!';
        header("Location: /auth/logout.php");
    }
}
?>
<div class="d-flex flex-wrap flex-justify-center container mt-5">
  <h1 class="w-100 text-center text-bold">My Profile</h1>
    <?php if (!empty($message)): ?>
      <h4 class="w-100 text-bold mb-10 text-center fg-red"><?= $message ?></h4>
    <?php endif; ?>

  <form class="w-100 w-50-md" action="profile.php" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input id="username"
             name="username"
             type="text"
             data-role="input"
             placeholder="Enter username"
             value="<?= $user->getUsername() ?>">
    </div>
    <div class="form-group">
      <label for="full_name">Full Name</label>
      <input id="full_name"
             name="full_name"
             type="text"
             data-role="input"
             placeholder="Enter Full Name"
             value="<?= $user->getFullName() ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email"
             name="email"
             type="email"
             data-role="input"
             placeholder="Enter email"
             value="<?= $user->getEmail() ?>">
    </div>
    <div class="form-group">
      <label for="contact_number">Contact Number</label>
      <input id="contact_number"
             name="contact_number"
             type="tel"
             data-role="input"
             placeholder="Enter Contact Number"
             value="<?= $user->getContactNumber() ?>">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input id="address"
             name="address"
             type="text"
             data-role="input"
             placeholder="Enter address"
             value="<?= $user->getAddress() ?>">
    </div>
    <div class="d-flex flex-justify-between form-group mt-5">
      <input type="reset" class="button" value="Reset">
      <button class="button success">Update</button>
    </div>
  </form>

  <div class="w-100 mb-10"></div>
  <a class="mb-5 button alert flex-self-end"
     onclick="return confirm('Are you sure you want to delete your account?')"
     href="profile.php?op=delete&id=<?= $user_id ?>">
    Delete My Account
  </a>
</div>
<?php include "../footer.php"; ?>
