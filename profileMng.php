<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header("Location: login.php?pleaseLogin");
  }
  include_once("ConnectorDb.php");

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
    <?php
    $sql = "SELECT * FROM  users";
    $result = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result) > 0){
      while ($row = $result->fetch_assoc()){

        $id = $_SESSION['id'];
        $sqlImg = "SELECT * FROM pimg WHERE userId='$id' ";
        $result2 = mysqli_query($mysqli, $sqlImg);
        //check status of the user
        while ($rowImg = $result2->fetch_assoc()){
              echo "<div>";
                        if($rowImg['status'] == 0){
                              echo "<img src=''images/default".$id.".png' >";
                        }else{
                          echo "<img src='images/default.jpg' tab='Avatar' class = 'avatar'  >";
                        }

              echo "</div>";

        }
      }
    }









    ?>
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



                echo'
                  <form action="uploadImg.php" method = "POST" enctype="multipart/form-data" >
                   <input type="file" name="file">
                    <input type ="submit" name="upload" value="upload-Avatar">
                  </form>
                ';
                      echo "<tr>";

                          echo "<td>" . $row['Id'] . "</td>";
                          echo "<td>" . $row['UserName'] . "</td>";
                          echo "<td>" . $row['EmailAddress'] . "</td>";
                          echo'<td>
                            <form action="edit.php" method = "POST" >
                              <input type = "hidden" name = "email" value="'.$row['EmailAddress'].'">
                              <input type = "submit" name = "edit" value="Edit">
                              <input type = "submit" name = "delete" value="Delete">
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
