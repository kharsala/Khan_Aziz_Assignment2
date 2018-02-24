<?php
  session_start();
  include_once("blogDb.php");



  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
          @$title = strip_tags(trim($_POST['blogtitle']));
          $content = strip_tags(trim($_POST['content']));
          $date  = date('"D M j G:i:s T Y"');

          $stmt = $mysqli -> prepare ("INSERT into posts (title, content, date ) values (?,?,?) ");
          $stmt ->bind_param("sss",     $title , $content, $date );

          $stmt->execute();
          $stmt->close();
          
         echo"Blog Sucessfuly Posted";


  }


 ?>

 <html>
  <head>
    <title>Post-Blog</title>
        <link href="app.css" rel="stylesheet" type="text/css" >
  </head>
 <body>

   <div>

     <header><h1>Create-Blog</h1></header>

   </div>

   <div class="main-body-Form">
      <form action="post.php" method="post" enctype="multipart/form-data" >
        <input type="text" name="blogTitle" placeholder="Title"><br>
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
