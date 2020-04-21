<?php
$pageTitle = 'Register';
$bodyClass = 'bg-lightIndigo';
include "../header.php";
include "../navbar.php";
require_once "../db/mysql.php";
require_once "../db/dao_user.php";
require_once "../model/user.php";

$message = '';

// handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_username = $_POST['username'];
    $post_full_name = $_POST['full_name'];
    $post_email = $_POST['email'];
    $post_password = $_POST['password'];
    $post_contact_number = $_POST['contact_number'];
    $post_address = $_POST['address'];
    $post_confirm_password = $_POST['confirm_password'];

    if (empty($post_username) or
        empty($post_full_name) or
        empty($post_email) or
        empty($post_password) or
        empty($post_confirm_password) or
        empty($post_contact_number) or
        empty($post_address)
    ) {
        $message = 'Some fields are empty!';
    } elseif ($post_password !== $post_confirm_password) {
        $message = 'Password do not match';
    } elseif (does_username_exist($post_username)) {
        $message = 'Username already exists';
    } else {
        // all good, insert into db
        $user = new User(0, $post_username, $post_full_name, $post_email, $post_password, $post_contact_number, $post_address);
        $conn = get_connection();

        $is_success = add_user($user);
        if ($is_success) {
            $message = 'Successfully registered user!';
            $_SESSION['username'] = $post_username;
            header("Location: /user/dashboard.php");
        } else {
            $message = 'Cannot add user at the moment. Please try again.';
        }
    }

}
?>
<div class="container-fluid d-flex flex-justify-center">
  <div class="p-5 mt-20 mb-20 bg-light w-100 w-50-md">
    <h2>Register</h2>
    <form action="register.php" method="post">
      <h5 class="fg-red"><?= $message ?></h5>
      <div class="form-group">
        <label>Username</label>
        <input name="username" type="text" data-role="input" placeholder="Enter username"/>
      </div>
      <div class="form-group">
        <label>Full Name</label>
        <input name="full_name" type="text" data-role="input" placeholder="Enter full name"/>
      </div>
      <div class="form-group">
        <label>Email address</label>
        <input name="email" type="email" data-role="input" placeholder="Enter email"/>
      </div>
      <div class="form-group d-flex flex-wrap">
        <label class="w-100">Password</label>
        <input name="password" type="password" data-role="input" placeholder="Enter password"/>
        <input class="mt-1" name="confirm_password" type="password" data-role="input" placeholder="Re-enter password"/>
      </div>
      <div class="form-group">
        <label>Contact Number</label>
        <input name="contact_number" type="text" data-role="input" placeholder="Enter contact number"/>
      </div>
      <div class="form-group">
        <label>Address</label>
        <input name="address" type="text" data-role="input" placeholder="Enter address"/>
      </div>
      <div class="form-group mt-10">
        <button class="button success">Register</button>
        <input type="button" class="button" value="Cancel">
      </div>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
