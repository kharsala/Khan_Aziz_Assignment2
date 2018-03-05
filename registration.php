<?php
session_start();
include_once("ConnectorDb.php");
?>
<?php
if(isset($_POST['register'])){

  //striping the input data of the tags
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $cpassword = strip_tags($_POST['confirmpassword']);

           //striping the slaches
            $username =  stripslashes($username);
            $email =stripslashes($email);
            $password =  stripslashes($password);
            $cpassword =  stripslashes($cpassword);

            $username = mysqli_real_escape_string($mysqli, $username);
           $email = mysqli_real_escape_string($mysqli, $email);
          $password= mysqli_real_escape_string($mysqli, $password);
          $cpassword= mysqli_real_escape_string($mysqli, $cpassword);

            $password= md5($password);
              $cpassword= md5($cpassword);

            $avatar_path = $mysqli ->real_escape_string(($_FILES['avatar']['name']));
            //lets check if the passwords match
            if($password == $cpassword){
                //check if file type is an image
                if(preg_match("!image!", $_FILES['avatar']['type'])){
                  //copy image to image/ folder
                  if(copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                    $_SESSION['avatar'] = $avatar_path;
                    //now inserting data into the users database
                    $query = "INSERT INTO users (UserName, EmailAddress, Password, avatar) VALUES (?, ?, ?, ?)";
                      $stmt = $mysqli -> prepare ($query);
                    $stmt ->bind_param("ssss",   $username , $email, $password, $avatar_path );
                     $stmt->execute();
                    if($stmt->execute() === true){
                      $_SESSION['message'] = 'Successfuly registered ';
                      $stmt->close();

                            header("Location: login.php");


                    }else{
                      $_SESSION['message'] = "Failed to add $username ";
                    }


                  }else{
                      $_SESSION['message'] = "Failed to upload image ";
                  }

                }else{
                    $_SESSION['message'] = "Please only upload a GIF, JPG, PNG images";
                }
            }
            else{
                $_SESSION['message'] = "Password mismatch";
            }

}

?>


<html>
<head>
  <meta character="UTF-8">
  <title>Register</title>
  <link href="app.css" rel="stylesheet" type="text/css" >
</head>
<body>
  <header>
    <nav id="globalnav">


           <a  href="index.php">Home</a>
           <a href="login.php">Login</a>
           <a class = "active" href="registration.php">Sign-Up</a>
           <a  href="profileMng.php">ProfileMng</a>
          <a  href="blogMng.php">BlogMng</a>

    </nav>
</header>
  <h1>Sign-Up</h1>


    <div class="main-body-Form">
     <form id="userForm" action="registration.php" method="post" enctype="multipart/form-data" autocomplete="off">
       <h1>Create an account</h1>

            <div class="alert alert-error"></div>
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="User Name" name="username" required /><div>
            <input type="email" placeholder="Email" name="email" required /><div>
            <input type="password" placeholder="Password" name="password" autocomplete="new-password" required /><div>
            <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required /><div>
            <div class="avatar"><label>avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
            <input type="submit" value="Register" name="register"/>
            <input type="reset" value="Register" name="reset"/>


            <p>Already have an account? <a id = "login" href="login.php">Login here</a></p>
     </form>
   </div>


       <div class="footer">

        <footer id="cpright" >   copyrights Arsalan Khan And Hasib Aziz ..... 2018   </footer>

     </div>

</body>
</html>
