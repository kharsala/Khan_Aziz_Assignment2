<?php
  session_start();
  if(!isset($_SESSION['id'])){

    header("Location: login.php");


  }
  if(isset($_SESSION['username'])){
    $pstUser = $_SESSION['username'];
  }
 include_once('ConnectorDb.php');


  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
          $title = strip_tags($_POST['title']);
          $content = strip_tags($_POST['content']);
          $date  = date('"D M j G:i:s T Y"');

          $title = stripslashes($title);
          $content = stripslashes($content);


        $title = mysqli_real_escape_string($mysqli, $title);
        $content=  mysqli_real_escape_string($mysqli, $content);


          $stmt = $mysqli -> prepare ("INSERT into posts (title, content, date, UserName ) values (?,?,?,?) ");
          $stmt ->bind_param("ssss",     $title , $content, $date, $pstUser );
          $stmt->execute();
       $stmt->close();
       echo"Blog Sucessfuly Posted";
      header("location: userPage.php");



  }


 ?>

 <html>
  <head>
    <title>Post-Blog</title>
        <link href="app.css" rel="stylesheet" type="text/css" >
  </head>
 <body>

   <div class="navigation">

               <header>
                 <nav id="globalnav">

                       <a href="index.php">Home</a>
                     <a href="logout.php">logout</a>
                     <a  href ="userPage.php"> My-Profile</a>
                     <a href="blogs.php">View-Posts</a>
                     <a class ="active" href="post.php">Create-Post</a>
                     <!--<a href ="Admin.php">Admin-Login</a> -->
                   <!--  <a href ="userPage.php"> My-Profile</a> -->
                 </nav>
               </header>
   </div>


       <h1>Create-Blog</h1>




   <div class="main-body-Form">
      <form action="post.php" method="post" enctype="multipart/form-data" >
        <input type="text" name="title" placeholder="Title"><br>
        <textarea type="text" name="content" placeholder="Start Writing"></textarea><br>
        <input type="submit" value = "Post Blog">
        <input type="reset" value = "Erase-All">

      </form>

   </div>
   <div>
     <footer></footer>
   </div>

 </body>

 </html>
