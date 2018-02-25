<?php
  session_start();
  include_once("ConnectorDb");

  ///checking to see if the user is loged in and the blog is his inorder to delete it
  //else just redirect the user to the userpage pr main page
  if(!isset($_SESSION['username']))
  {
        //the location to redirect of the username session is not set
        header("Location: login.php");
  }
  if(!isset($_SESSION['id'])){
      header("Location: userPage.php");
  }
  else if (isset($_SESSION['id'])){
    //get the process if from the url
    $psid = $_GET['psid'];
    $delete = "DELETE FROM posts Where Id = $psid";
     mysqli_query($mysqli, $delete);
     header("Location: blogs.php");

  }


 ?>
