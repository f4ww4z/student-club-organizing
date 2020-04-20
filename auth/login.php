<?php
$pageTitle = 'Login';
$bodyClass = 'bg-lightIndigo';
include "../header.php";
include "../navbar.php";
require_once "../db/mysql.php";
require_once "../db/user_dao.php";
require_once "../model/user.php";

$message = '';
$post_username = '';

// handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_username = $_POST['username'];
    $post_password = $_POST['password'];
    if (empty($post_username) or
        empty($post_password)
    ) {
        $message = 'Username or password cannot be empty.';
    } elseif (!does_user_exist($post_username, $post_password)) {
        $message = 'Invalid username or password';
    } else {
        // all good, take user to user
        $_SESSION['username'] = $post_username;
        header("Location: /user/dashboard.php");
    }
}
?>
<div class="container-fluid d-flex flex-justify-center">
  <div class="p-5 mt-20 bg-light w-100 w-50-md">
    <h2>Login</h2>
    <form action="login.php" method="post">
      <h5 class="fg-red"><?= $message ?></h5>
      <div class="form-group">
        <label>Username</label>
        <input name="username"
               type="text"
               data-role="input"
               placeholder="Enter username"
               value="<?= $post_username ?>"/>
      </div>
      <div class="form-group d-flex flex-wrap">
        <label class="w-100">Password</label>
        <input name="password" type="password" data-role="input" placeholder="Enter password"/>
      </div>
      <div class="form-group mt-10">
        <button class="button success">Login</button>
        <input type="button" class="button" value="Cancel">
      </div>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
