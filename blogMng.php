<?php
  session_start();
  if(!isset($_SESSION['id'])){

    header("Location: login.php?PleaseLogin");


  }
  if(isset($_SESSION['username'])){
    $pstUser = $_SESSION['username'];
  }
 include_once('ConnectorDb.php');


  if(isset($_POST['post']) )
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
      header("location: blogMng.php");



  }


 ?>

 <html>
  <head>
    <title>Post-Blog</title>
    <meta charset="UTF-8">
        <link href="app.css" rel="stylesheet" type="text/css" >
  </head>
 <body>

   <div class="navigation">

     <header>
       <nav id="globalnav">



              <a   href="index.php">Home</a>
                <a href="logout.php">logout</a>
             <a href="profileMng.php">ProfileMng</a>
             <a  class = "active" href="blogMng.php">BlogMng</a>


       </nav>
   </header>

   </div>

      <h1>Welcome <?php echo $_SESSION['username'];  ?></h1>
       <h1>Create-Blog</h1>




   <div class="main-body-Form">
      <form action="blogMng.php" method="post" enctype="multipart/form-data" >
        <input type="text" name="title" placeholder="Title"><br>
        <textarea type="text" name="content" placeholder="Start Writing"></textarea><br>
        <input type="submit" value = "Post Blog" name="post">
        <input type="reset" value = "Erase-All">

      </form>
      <h2>Your-Blogs</h2>

      <?php
        require_once("nbbc/nbbc.php");
        //creating a bbcode object
        //name of the user
       $user = $_SESSION['username'];
        $bbcode = new BBCode;
        $selectQ = "SELECT  * from posts WHERE UserName ='$user'  ORDER BY Id DESC";
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

                        <form action="editBlog.php" method = "post">
                          <input type = "hidden" name="title" value="'.$title.'">
                          <input type = "submit"  value="Edit">
                        </form>

                        <form action="deleteBlog.php" method = "post">
                        <input type = "hidden" name="id" value="'.$id.'">
                        <input type = "hidden" name="username" value= "'.$userName.'" >
                          <input type = "submit" name="delete" value="Delete">
                        </form>


              </div>
              ';
          }
          //echo $admin;
        }else{
          echo "Not Posts Yet";
        }


      ?>


   </div>

       <div class="footer">
        <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
      </div>

 </body>

 </html>
