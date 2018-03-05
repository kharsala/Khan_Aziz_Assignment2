<?php
session_start();
$_SESSION['message'] = ' ';
include_once("ConnectorDb.php");
if(isset($_POST['upload'])){

            $avatar_path = $mysqli ->real_escape_string(($_FILES['avatar']['name']));
            //lets check if the passwords match

                //check if file type is an image
                if(preg_match("!image!", $_FILES['avatar']['type'])){
                  //copy image to image/ folder
                  if(copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                    $_SESSION['avatar'] = $avatar_path;

                  }else{
                      $_SESSION['message'] = "Failed to upload image ";
                  }

                }else{
                    $_SESSION['message'] = "Please only upload a GIF, JPG, PNG images";
                }
            }


?>


<?php

if(!isset($_SESSION['id'])){
  header("Location: login.php?pleaseLogin");
}
$title = $_SESSION['avatar'];
?>
<html>

<head>
  <link href="app.css" rel="stylesheet" type="text/css" >
  <meta charset="UTF-8">
  <title>Welcome_Blog</title>
</head>

<body>

      <header>
        <nav id="globalnav">


            <a   href="index.php">Home</a>
              <a href="logout.php">logout</a>
               <a class = "active" href="profileMng.php">ProfileMng</a>
               <a   href="blogMng.php">BlogMng</a>


        </nav>
    </header>
    <div>
      <span class="user"><img src= <?= $title ?> class="avatar"  </span>

    </div>

        <div class="main-body-Form">
         <form id="userForm" action="profileMng.php" method="post" enctype="multipart/form-data" autocomplete="off">


                <div class="alert alert-error"></div>
                <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
                <div class="avatar"><label>avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
                <input type="submit" value="NewAvatar-Upload" name="upload"/>
         </form>
       </div>
    <div>
    <?php

    if(!isset($_SESSION['username'])){
      header("Location: login.php");
    }

    if(isset($_SESSION['id']))
    {

      $pid = $_SESSION['id'];
      $Query = "SELECT * from users where Id= $pid ";
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




                    echo "<tr>";

                        echo "<td>" . $row['Id'] . "</td>";
                        echo "<td>" . $row['UserName'] . "</td>";
                        echo "<td>" . $row['EmailAddress'] . "</td>";
                        echo'<td>
                          <form action="edit.php" method = "POST" >
                            <input type = "hidden" name = "email" value="'.$row['EmailAddress'].'">
                            <input type = "submit" name = "edit" value="Edit">

                          </form>

                        </td>';
                    echo "</tr>";



            }
             echo "</table>";

    }
    }else{
      header("Location: login.php");
    }

    ?>
  </div>
    <div class="footer">

     <footer id="cpright" >   copyrights Arsalan Khan And Hasib Aziz ..... 2018   </footer>

  </div>
</body>



</html>
