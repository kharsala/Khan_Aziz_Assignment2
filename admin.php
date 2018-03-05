<?php
session_start();
if(isset($_SESSION['role'])){
  if(isset($_SESSION['id'])){

  }
}else{
  header("Location: login.php");
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


        <a class ="active" href="admin.php">Admin-Home</a>
        <a  href="userDetails.php">userDetails</a>
         <a href="logout.php">Logout</a>

  </nav>
</header>

<body>
  <h1>Welcome Admin: <?php echo $_SESSION['username'];?> </h1>

  <div class="footer">
      <h2 id="cpright">Copyrights Khan and Aziz...2018</h2>
  </div>
</body>



</html>
