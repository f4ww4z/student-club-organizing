<?php
$is_authenticated = (session_status() == PHP_SESSION_ACTIVE and !empty($_SESSION['username']));
$username = '';

if ($is_authenticated) {
    $username = $_SESSION['username'];
}
?>
<div class="fg-white bg-indigo" data-role="appbar" data-expand-point="md">
  <a href="/" class="brand">
    <b>Student Club Organizer</b>
  </a>

  <ul class="app-bar-menu ml-auto">
      <?php if ($is_authenticated): ?>
        <li><a href="/user/dashboard.php"><?= $username ?></a></li>
        <li><a href="/auth/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="/auth/login.php">Login</a></li>
        <li><a href="/auth/register.php">Sign Up</a></li>
      <?php endif; ?>
  </ul>
</div>
