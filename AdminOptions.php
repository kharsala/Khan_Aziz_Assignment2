<?php
session_start();
 include_once ("ConnectorDb.php");
 if(!isset($_SESSION['id'])){
      header("Location: login.php");
 }

 $edit_state = false;

 //if create option is selected
   if(isset($_POST['create'])){
     $username = ($_POST['username']);
     $email = ($_POST['email']);
     $password = ($_POST['password']);
     header('location: Admin.p');
   }

//if edit option is selected
  if(isset($_POST['edit'])){
    $id = mysqli_real_escape_string($_POST['id']);
    $username = mysqli_real_escape_string($_POST['username']);
    $email = mysqli_real_escape_string($_POST['email']);
    $password = mysqli_real_escape_string($_POST['password']);

    mysqli_query($mysqli, "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id");
    $_SESSION['message'] = "Information Saved!";
    header('location: Admin.php');
  }

//if delete option is selected
  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($mysqli, "DELETE FROM users WHERE id=$id");
    $_SESSION['message'] = "Information Deleted!";
    header('location: Admin.php');
  }
 //to display records
 $results = mysqli_query($mysqli, "SELECT * FROM users");


 ?>
