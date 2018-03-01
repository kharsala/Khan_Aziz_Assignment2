<?php
  session_start();
  include_once("ConnectorDb.php");

?>
<?php
   //php for dealing with the avatar image upload
      $targetImg_dir = 'image/';
      @$targetfile = $targetImg_dir . basename($_FILES['file']['name']);
    @$imgName = $_FILES['file']['name'];
      $upload = 1;
      $FileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));
      if (isset($_POST['file'])){

         $check = getimagesize($_FILES["file"]["tmp_name"]);
         if($check !== false) {
        echo "File  " . $check["mime"] ."<br>";
        $upload = 1;
        } else {
          echo "File is not an image.";
          $upload = 0;
        }
        if (file_exists($targetfile)) {
            echo "Sorry, file already exists.". "<br>";
              $upload= 0;
            }
    if ($_FILES["file"]["size"] > 500000)
    {
        echo "Sorry, your file is too large.";
        $upload = 0;
    }
    //getting the file type
    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif" )
    {
      echo " only JPG, JPEG, PNG & GIF files.";
      $upload= 0;// no upload
    }
    //now check if a nupload was made
    if($upload == 0){
      echo "Upload failed";
    }else{

      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetfile)){
            echo "succceful upload";

      }else{
        echo "Failed to upload Img";
      }



    }
    $query = "UPDATE users SET profileImg = ' ". $_FILES['file']['name']."'  where UserName = '".$_SESSION['username']." '  " ;
    $mysqli->query($query);

    $pid = $_SESSION['id'];
    $Query = "SELECT Id, UserName, EmailAddress, profileImg from users where Id= $pid ";
    $result = $mysqli->query($Query);
      if($result->num_rows > 0){


          while($row = $result->fetch_assoc()){


            if(($row['profileImg']) == null ){

          echo'<img src="image/default.png" alt="Avatar" class="avatar"> ';
        }
        else{
                $image = $targetImg_dir . $row['profileImg'];
                echo'<img src="'.$targetfile.'" alt="Avatar" class="avatar"> ';
        }

          }


      }else{

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
                if(($row['profileImg']) = null ){

              echo'<img src="image/default.png" alt="Avatar" class="avatar"> ';
            }
            else{

                    echo'<img src="'.$targetfile.'" alt="Avatar" class="avatar"> ';
            }





                echo'
                  <form action="profileMng.php" method = "POST" enctype="multipart/form-data" >
                   <input type="file" name="file">
                    <input type ="submit" name="file" value="upload-Avatar">
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
