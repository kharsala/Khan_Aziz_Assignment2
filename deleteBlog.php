<?php
  session_start();
  include_once("ConnectorDb.php");

  ///checking to see if the user is loged in and the blog is his inorder to delete it
  //else just redirect the user to the userpage pr main page
  if(!isset($_SESSION['id'])){
      header("Location: index.php");
  }
    //get the process if from the url
    if(isset($_POST['delete'])){


    $postID = $_POST['id'];
    $delete = "DELETE FROM posts Where Id = ?";
    $stmt = $mysqli -> prepare ($delete);
    $stmt ->bind_param("i",  $postID);
    $stmt->execute();
 $stmt->close();

     header("Location: blogMng.php");
   }
   



 ?>
