<?php
session_start();
include_once("ConnectorDb.php");

if(!isset ($_SESSION['id']))
{
  header("Location: login.php");
}
if(isset($_POST['submit']))
{
      $id = $_SESSION['id'];
    @  $username = strip_tags($_POST['username']);
    @  $email = strip_tags($_POST['email']);

      $username =  stripslashes($username);
      $email =stripslashes($email);

      $username = mysqli_real_escape_string($mysqli, $username);
      $email = mysqli_real_escape_string($mysqli, $email);


      $up = "UPDATE users
      SET UserName = $username, EmailAddress = $email,
      WHERE Id =$id LIMIT 1 ";
      if ($mysqli->query($up) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();

}


?>

<html>
  <head>
    <link type="text/css" href="app.css" rel ="stylesheet">

  </head>
  <body>

    <h1>EditProfile</h1>

  <div class="main-body-Form">
   <form id="userForm" action="edit.php" method="post">

        UserName:<br>
          <input type="text" name="username" value = "<?php echo $_SESSION['username']; ?>"             required/><br>
        E-mail:<br>
            <input type="text" name="email"  value="<?php echo $_POST['email'] ?>"  required/><br>

        <input type="submit" name="submit" value="register" />
        <input type="reset" value="reset" /><br>


   </form>
 </div>



  </body>
</htm>
