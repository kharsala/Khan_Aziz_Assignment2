<?php
  session_start();
  include_once("ConnectorDb.php");
?>
<?php
  if (isset($_POST['submit'])){
    $pid =$_SESSION['id'];
    $pImg= "SELECT * FROM Profileimage where userId= $pid ";
    $resultImg = $mysqli->query($pImg);
    //check a statis
    while($rowImg = $resultImg-> fetch_assoc()){
       echo"<div>";
         if($rowImg["status"] == 0){
                  echo'<img src="image/default.jpg" alt="Avatar" class="avatar"> ';
         }else{
             echo'<img src="image/default.jpg" alt="Avatar" class="avatar"> ';
         }


    }

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
        $Query = "SELECT Id, UserName, EmailAddress from users where Id= $pid ";
        $result = $mysqli->query($Query);
        if($result->num_rows > 0){


          $pImg= "SELECT * FROM Profileimage where userId= $pid ";
          $resultImg = $mysqli->query($pImg);
          //check a statis
          while($rowImg = $resultImg-> fetch_assoc()){

               if($rowImg['status'] == 0){

               }else{
                    echo'<img src="image/default.jpg" alt="Avatar" class="avatar"> ';
               }


          }
echo'<img src="image/default.jpg" alt="Avatar" class="avatar"> ';
        echo "<table id='users-table'>";
              echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>UserName</th>";
                    echo "<th>Email</th>";
                    echo "<th>Edit-User</th>";
              echo "</tr>";
              while($row = $result->fetch_assoc()){
                echo'
                  <form action="userPage.php" method = "POST" >
                   <input type="file" name="file">
                    <input type = "submit" value="upload-Image">
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




        echo'






        ';
      ?>
    </div>


  </body>
</html>
