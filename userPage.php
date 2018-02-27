<?php
session_start();
if(!isset($_SESSION['id'])){

  header("Location: login.php");


}

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
          <a class ="active" href ="userPage.php"> My-Profile</a>
            <a href="blogs.php">ViewMyPosts</a>
          <a href="post.php">Create-Post</a>
          <!--<a href ="Admin.php">Admin-Login</a> -->
        <!--  <a href ="userPage.php"> My-Profile</a> -->
      </nav>
  </header>

<body>
    <h1>Welcome <?php echo $_SESSION['username'] ?> </h1>
    <?php
    if (isset($_POST['submit'])){
      $pid =$_SESSION['id'];
      $pImg= "SELECT * FROM Profileimage where userId= $pid ";
      $resultImg = $mysqli->query($pImg);
      //check a statis
      if($resultImg ->num_rows > 0){
      while($rowImg = $resultImg-> fetch_assoc()){
         echo"<div>";
           if($rowImg["status"] == 0){
                 echo'<img src="http://www.whatsupdoc-lemag.fr/userfiles/actumag/ThinkstockPhotos-521808958.jpg" >';
           }else{
                 echo"<img  src='default.jpg'> ";
           }


      }
    }

    }



    ?>

    <form action="profileMng.php" method = "POST" >

                             <input type = "submit" value="ManageProfile">
  </form>



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
