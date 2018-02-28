<?php
  session_start();
  include_once("ConnectorDb.php");
?>
<?php
  if (isset($_POST['file'])){
    //$pid =$_SESSION['id'];
    //$pImg= "SELECT * FROM Profileimage where userId= $pid ";
    //$resultImg = $mysqli->query($pImg);
    //check a statis
  $target_dir = "image/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],  "image/". $_FILES['file']['name']);
    $query = "UPDATE users SET profileImg = ' ". $_FILES['file']['name']."'  where UserName = '".$_SESSION['username']." '  " ;
    $mysqli->query($query);



  }

 ?>

<html>
  <head>
    <title>Mange-Profile</title>
  <link href="app.css" rel="stylesheet" type="text/css" >
  </head>

  <body>
    <header>
      <nav id="globalnav">

            <a href="index.php">Home</a>
          <a href="logout.php">logout</a>
          <a  class="active" href ="userPage.php"> My-Profile</a>
          <a  href="blogs.php">View-Posts</a>
          <a  href="post.php">Create-Post</a>
          <!--<a href ="Admin.php">Admin-Login</a> -->
        <!--  <a href ="userPage.php"> My-Profile</a> -->
      </nav>
    </header>
    <div>
      <?php

      if(!isset($_SESSION['username'])){
        header("Location: login.php");
      }
      if(isset($_SESSION['id']))
      {
        $pid = $_SESSION['id'];
        $Query = "SELECT Id, UserName, EmailAddress, profileImg from users where Id= $pid ";
        $result = $mysqli->query($Query);

        if($result->num_rows > 0){
          //check a statis
        echo "<table id='users-table'>";
              echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>UserName</th>";
                    echo "<th>Email</th>";
                    echo "<th>Edit-User</th>";
              echo "</tr>";
              while($row = $result->fetch_assoc()){
                  $profileImg = $row['profileImg'];
                if(($row['profileImg']) == null ){

                echo'<img src="image/default.jpg" alt="Avatar" class="avatar"> ';
              }
              else{

              }
                echo'
                  <form action="profileMng.php" method = "POST" enctype="multipart/form-data" >
                   <input type="file" name="file">
                    <input type ="submit" name="file" value="upload-Image">
                  </form>
                ';
                      echo "<tr>";

                          echo "<td>" . $row['Id'] . "</td>";
                          echo "<td>" . $row['UserName'] . "</td>";
                          echo "<td>" . $row['EmailAddress'] . "</td>";
                          echo'<td>
                            <form action="editUser.php" method = "POST" >
                              <input type = "submit" value="Edit">
                            </form>
                          </td>';
                      echo "</tr>";



              }
               echo "</table>";

      }
      }else{
        header("Location: userPage.php");
      }

      ?>
    </div>


  </body>
</html>
