<?php
  session_start();
  include_once("ConnectorDb.php");

  ///checking to see if the user is loged in and the blog is his inorder to delete it
  //else just redirect the user to the userpage pr main page
  if(!isset($_SESSION['username']))
  {
        //the location to redirect of the username session is not set
        header("Location: login.php");
  }
  if(!isset($_SESSION['id'])){
      header("Location: login.php");
  }
  else{
    //get the process if from the url
    $postUser= $_SESSION['username'];
    $delete = "DELETE FROM posts Where UserName = $postUser";
     mysqli_query($mysqli, $delete);
     header("Location: blogs.php");

  }


 ?>
