<?php
session_start();
if(!isset($_SESSION['id'])){
  header("Location: login.php");
}

?>
<?php
include_once("ConnectorDb.php");
if(isset($_POST['submit']))
{
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);
        $date  = date('"D M j G:i:s T Y"');


        $title = stripslashes($title);
        $content = stripslashes($content);


      $title = mysqli_real_escape_string($mysqli, $title);
      $content=  mysqli_real_escape_string($mysqli, $content);
      $username = $_SESSION['username'];


        $stmt = $mysqli -> prepare ("UPDATE posts SET title = ?, content= ?, date = ?  WHERE UserName= ?  ") or die("error");
        $stmt ->bind_param("ssss",  $title , $content, $date, $username );
        $stmt->execute();
     $stmt->close();
     $_SESSION['message'] = "Blog Edited";
    header("location: blogMng.php");
}

$username = $_SESSION['username'];
 $select = "SELECT * FROM posts where UserName = '$username'";
 $result = $mysqli->query($select);
 if($result->num_rows > 0){
   while($row = mysqli_fetch_assoc($result)){
     $title = $row['title'];
     $content = $row['content'];

   }

 }


?>

<html>
<head>
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


<h1>Edit-Blog</h1>
  <div class="main-body-Form">
     <form action="editBlog.php" method="post" enctype="multipart/form-data" >
       <input type="text" name="title" placeholder="Title" value="<?php echo $title; ?>" ><br>
       <textarea type="text" name="content" ></textarea><br>
       <input type="submit" name ="submit" value = "Re-Submit">
       <input type="reset" value = "Erase-All">

     </form>
     <h2>Blog To Be Edited Editing</h2>

     <?php
       require_once("nbbc/nbbc.php");
       //creating a bbcode object
       //name of the user
      $title = $_POST['title'];
       $bbcode = new BBCode;
       $selectQ = "SELECT  * FROM posts WHERE title ='$title'  ORDER BY Id DESC";
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
         echo "No Posts Yet";
       }


     ?>

         <div class="footer">
          <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
        </div>

</body>

</html>
