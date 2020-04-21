<?php
$is_authenticated = (session_status() == PHP_SESSION_ACTIVE and !empty($_SESSION['username']));
$username = '';

if ($is_authenticated) {
    $username = $_SESSION['username'];
}
?>
<!-- Top nav -->
<div class="fg-white bg-indigo" data-role="appbar" data-expand-point="md">
  <a href="/" class="brand">
    <b>Student Club Organizer</b>
  </a>

  <ul class="app-bar-menu ml-auto">
      <?php if ($is_authenticated): ?>
        <li>
          <a href="/user/dashboard.php">
            <b><?= $username ?></b>
          </a>
        </li>
        <li><a href="/auth/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="/auth/login.php">Login</a></li>
        <li><a href="/auth/register.php">Sign Up</a></li>
      <?php endif; ?>
  </ul>
</div>
<!-- Side nav -->
<?php if ($is_authenticated): ?>
  <div class="bottom-nav pos-fixed">
    <button class="button">
      <a class="no-decor fg-black fg-indigo-hover" href="/club/club_view.php">
        <span class="icon mif-users"></span>
        <span class="label">Clubs</span>
      </a>
    </button>
    <button class="button">
      <a class="no-decor fg-black fg-indigo-hover" href="/club/club_view.php">
        <span class="icon mif-event-available"></span>
        <span class="label">Events</span>
      </a>
    </button>
    <button class="button">
      <a class="no-decor fg-black fg-indigo-hover" href="/user/profile.php">
        <span class="icon mif-user"></span>
        <span class="label">My Profile</span>
      </a>
    </button>
  </div>
<?php endif; ?>
