<?php
  session_start();
  $_SESSION['message'] = "You Have bin Logged out";
  Session_destroy();

header("Location: login.php");

?>
