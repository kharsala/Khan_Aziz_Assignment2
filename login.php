<?php
session_start();
 require_once 'ConnectorDb.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = strip_tags($_POST['username']);
  $password = strip_tags($_POST['password']);

  $username =  stripslashes($username);
  $password =  stripslashes($password);

  $username = mysqli_real_escape_string($mysqli, $username);
  $password= mysqli_real_escape_string($mysqli, $password);

  //$password= md5($password);

  $dbQuery = "SELECT * FROM users WHERE UserName = '$username' LIMIT 1";
  $result = mysqli_query($mysqli, $dbQuery);
  $row = mysqli_fetch_array($result);

  $Id = $row['Id'];
  $db_password = $row['Password'];

  if($password == $db_password){
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $Id;
    header("Location: userPage.php");

  }else{
    echo "Invalid Username or Password";
  }




}
?>
<html >
<head>
    <title>Login</title>
    <link href="app.css" rel="stylesheet" type="text/css" >

</head>
<body>
    <div div class="main-body-Form">
        <h1>Login</h1>
      <form action="login.php" method="post">
        UserName:<br>
        <input type="text" name="username" required/><br>
        <input type="password" name="password" required/><br>
        <input type="submit" name="submit" value="Login"/>
        <input type="reset" value="Clear"/>
      </form>
        <p>Don't have an account? <a id = "login" href="registration.php">Sign-Up</a></p>
    </div>

    <div class="footer">
     <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
</body>

</html>
