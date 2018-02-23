<?php
  session_start();
  include_once("blogDb.php");
?>


<html>

<head>
  <link href="app.css" rel="stylesheet" type="text/css" >
  <title>Welcome_Blog</title>
</head>

    <header>
      <nav id="#ac-globalnav">

          <a href="registration.php">Sign-Up</a>
          <a href="login.php">Login</a>
          <!--<a href ="Admin.php">Admin-Login</a> -->
        <!--  <a href ="ProfileMgmt.php"> My-Profile</a> -->
      </nav>
  </header>

<body>
  <!-- Using the nbbc parser-->
    <h1 class="names"> Assignment 2 </h1>
  <?php
    require_once("nbbc/nbbc.php");
    //creating a bbcode object
    $bbcode = new BBCode;
    $selectQ = "SELECT  * from posts ORDER BY Id DESC";
    $result =  mysqli_query($mysqli, $selectQ);

    //$posts = "";
    if($result->num_rows > 0){

      echo "<table id='users-table'>";
      while($row = mysqli_fetch_assoc($result)){

        $id =  $row['Id'];
        $title = $row['title'];
        $content = $row['content'];
        $date = $row['date'];

        //this will format everything removing tags
        $output = $bbcode ->Parse($content);

            echo  $id ;
            echo $title;
            echo  $output;
            echo  $date;


      }
    }else{
      echo "Not Posts Yet";
    }

  ?>




    <div class="footer"
    <footer>
      <h2>Developers</h2>
        <ul>
          <li class="names">Arsalan Khan</li>
          <li class="names">Hasib Aziz</li>
        </ul>
          <h2 id="cpright">Copyrights Khan and Aziz...2018</h2>

    </footer>
  </div>
</body>



</html>
