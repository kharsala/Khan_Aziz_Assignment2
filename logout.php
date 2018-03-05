<?php
  session_start();
  $_SESSION['message'] = "You Have Been Logged Out";
  Session_destroy();

header("Location: login.php");

?>
