<?php
session_start();
 include_once ("ConnectorDb.php");
 if(!isset($_SESSION['id'])){
      header("Location: Admin.php");
 }
  $id = "";
  $username = "";
  $email = "";
  $password = "";
  $edit_state = false;

 //if save option is selected
   if(isset($_POST['save'])){
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];

     $query = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
     mysqli_query($database, $query);
     $_SESSION['message'] = "Information Saved!";
     header('location: Admin.php');
   }

//if edit option is selected
  if(isset($_POST['edit'])){
    $id = mysqli_real_escape_string($_POST['id']);
    $username = mysqli_real_escape_string($_POST['username']);
    $email = mysqli_real_escape_string($_POST['email']);
    $password = mysqli_real_escape_string($_POST['password']);

    mysqli_query($database, "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id");
    $_SESSION['message'] = "Information Edited!";
    header('location: Admin.php');
  }

//if delete option is selected
  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($database, "DELETE FROM users WHERE id=$id");
    $_SESSION['message'] = "Information Deleted!";
    header('location: Admin.php');
  }
 //to display records
 $results = mysqli_query($mysqli, "SELECT * FROM users");


 ?>
