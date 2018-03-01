<?php
  session_start();
 include_once('ConnectorDb.php');
?>


<html>

<head>
  <link href="app.css" rel="stylesheet" type="text/css" >
  <title>Welcome_Blog</title>
</head>

    <header>
      <nav id="globalnav">

            <a href="index.php">Home</a>
          <a href="logout.php">logout</a>
          <a  href ="userPage.php"> My-Profile</a>
          <a class="active" href="blogs.php">GlobalPosts</a>
          <a  href="post.php">Post</a>
          <!--<a href ="Admin.php">Admin-Login</a> -->
        <!--  <a href ="userPage.php"> My-Profile</a> -->
      </nav>
  </header>

<body>
  <!-- Using the nbbc parser-->
    <!--<h1 class="names"> Assignment 2 </h1> -->
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
