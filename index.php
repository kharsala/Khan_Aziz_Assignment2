<?php
  session_start();
 include_once('ConnectorDb.php');

?>

<?php
//send errors and warnings to log.txt file
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log', dirname(__FILE__) . '/log.txt');
error_reporting(E_ALL ^ E_DEPRECATED);

//require 'logtest.com';

 ?>
 <?php
 // Send error message to the log.txt file if failed to connect to db
 if (!mysqli_connect("$dbhost", "$username", "$dbpassword", "$database")) {
     error_log("Failed to connect to database!", 3, dirname(__FILE__) . '/log.txt');
 }

 ?>

<html>

<head>
  <link href="app.css" rel="stylesheet" type="text/css" >
  <meta charset="UTF-8">
  <title>Welcome_Blog</title>
</head>

<header>
  <nav id="globalnav">


         <a   class = "active" href="index.php">Home</a>
         <a href="login.php">Login</a>
         <a href="registration.php">Sign-Up</a>
        <a href="admin.php">Admin-Home</a>
       <a href="profileMng.php">ProfileMng</a>
        <a  href="blogMng.php">BlogMng</a>

  </nav>
</header>

<body>
  <!-- Using the nbbc parser-->
    <!--<h1 class="names"> Assignment 2 </h1> -->
    <h1>Global Posts</h1>
  <?php
    require_once("nbbc/nbbc.php");
    //creating a bbcode object

    $bbcode = new BBCode;
    $selectQ = "SELECT  * from posts ORDER BY Id DESC";
    $result = $mysqli->query($selectQ);

    if($result->num_rows > 0){


      while($row = mysqli_fetch_assoc($result)){

        $id =  $row['Id'];
        $content = $row['content'];
        $title = $row['title'];
        $date = $row['date'];
        $userName = $row['UserName'];

        //this will format everything removing tags
        $output = $bbcode ->Parse($content);
      echo '

        <div class="row">
          <div class="leftcolumn">
            <div class="card">
              <h2>'.$title.'</h2>
              <h4>'.$userName.'</h4>
                <h5>'.$date.'</h5>
                <!--  <div class="fakeimg" style="height:200px;">Image</div> -->
                    <p>'.$output.'</p>


          </div>
          ';
      }
      //echo $admin;
    }else{
      echo "Not Posts Yet";
    }


  ?>

  <div class="footer">
      <h2 id="cpright">Copyrights Khan and Aziz...2018</h2>
  </div>
</body>



</html>
