<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header("Location: login.php?pleaseLogin");
  }
  include_once("ConnectorDb.php");

  $id = $_SESSION['id'];
  $select = "SELECT * FROM users where Id = '$id ' ";
  $result = $mysqli->query($select);
  if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $username = $_SESSION['username'];
    $email = $row['EmailAddress'];
  }


?>
<?php

 if(isset($_POST['edit']))
 {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $date = new DateTime();
  $date = $date->format("y:m:d h:i:s");
  $text = $date . " Existing User Edited " . " Username = " . $username . " , " . "E-Mail = " . $email . " Password = " . $password ."\n";
  $fp = fopen('log.txt', 'a+');

    if(fwrite($fp, $text))  {
        echo 'saved';

    }
fclose ($fp);
}
?>
<html>
  <head>
    <title>Edit-User-Profile</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="app.css" rel="stylesheet" type="text/css" >
  </head>

  <body>
    <header>
      <nav id="globalnav">


          <a href="logout.php">logout</a>
          <!--<a href ="Admin.php">Admin-Login</a> -->
        <!--  <a href ="userPage.php"> My-Profile</a> -->
      </nav>
    </header>

    <div>
       <h1> Edit-Profile </h1>

          <div class="main-body-Form">
           <form id="userForm" action="userMng.php" method="post">

                UserName:<br>
                  <input type="text" name="username" value="<?php echo $username; ?>" required/><br>
                E-mail:<br>
                    <input type="email" name="email"  value="<?php echo $email; ?>"  required/><br>

                <input type="submit" name="edit" value="SubmitChages" />
                <input type="reset" value="reset" /><br>


           </form>

    <div class="footer">
        <h2 id="cpright">Copyrights  of Khan and Aziz...2018</h2>
    </div>

  </body>
</html>
