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
          <a class="active" href="blogs.php">View-Posts</a>
          <a  href="post.php">Create-Post</a>
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
    //$posts = "";
    if($result->num_rows > 0){


      while($row = mysqli_fetch_assoc($result)){

        $id =  $row['Id'];
        $content = $row['content'];
        $title = $row['title'];
        $date = $row['date'];

        $admin = "<div><a class ='admin' herf = 'deletePost.php?pid=$id'>Delete</a> &nbsp <a herf = 'deletePost.php?pid=$id'>Edit</a></div>";
        //this will format everything removing tags
        $output = $bbcode ->Parse($content);
       $posts  =
         "
         <div id= 'blog_pst'>
         <article>
        <h2><h1><a herf = 'deletePost.php?pid=$id'>$title</a></h1>
         <h3>$date</h3 >
         <p>$output</p>
        </article>
       </div>
       ";
       echo $posts;
       echo $admin;
      }

      //echo $admin;
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
