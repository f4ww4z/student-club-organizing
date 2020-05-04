<?php
$pageTitle = 'Home';
include "header.php";
include "navbar.php";
?>
<div class="d-flex flex-align-center flex-justify-center flex-column w-100 home-wide-display">
  <h1 class="text-center text-bold">Student Club Organizer</h1>
  <h3 class="text-center fg-dark">A powerful tool to manage your organization</h3>
  <a class="mt-6 button large bg-indigo bg-darkIndigo-hover fg-white" href="/auth/register.php">Get Started</a>
</div>
<div class="bg-darkIndigo fg-white p-6">
  <div class="container">
    <h1 class="text-bold">About Us</h1>
    <p style="font-size: 20px">
      We would like to provide a system that allow Universiti Malaysia Terengganu (UMT)
      clubs to create events. The origin of the idea on building our system is to help
      club representative build an event planning based on their club activity. The objective
      are as below :
    </p>
    <ol>
      <li>
        To analyze on events occurred in UMT created and organize by club’s person in charge.
      </li>
      <li>
        To design a perfect and efficient system that enables club to create an event that
        satisfies their exigency.
      </li>
      <li>
        To implement an easy approach of organizing event that supports the clubs’
        vision and mission.
      </li>
    </ol>
    <table>
      <tr>
        <td>
          <h2>Mission</h2>
          <p>
            <i>To end the contemporary unsystematic event organizing system and create
              a convenient and powerful event organizing system for user.</i>
          </p>
        </td>
        <td>
          <h2>Vision</h2>
          <p>
            <i>To create a user-friendly system which helps user to manage thier event
              well. Our system could also notify user on the scheduled time.</i>
          </p>
        </td>
      </tr>
    </table>
  </div>
</div>
<?php include "footer.php"; ?>
