<?php

session_start();
 include_once ("ConnectorDb.php");
//editing user userDetails
if(isset($_SESSION['id'])){
  if(isset($_POST['editform'])){
      header("Location: edit.php");
  }

  if(isset($_POST['edit'])){
        $id = $_SESSION['id'];
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);


       //striping the slaches
        $username =  stripslashes($username);
        $email =stripslashes($email);


        $username = mysqli_real_escape_string($mysqli, $username);
       $email = mysqli_real_escape_string($mysqli, $email);

        $updateUser = "UPDATE users SET UserName = ?, EmailAddress= ? Where Id = ? ";
        $stmt = $mysqli -> prepare ( $updateUser) or die("error");
        $stmt ->bind_param("ssi",  $username , $email, $id);
        $stmt->execute();
     $stmt->close();
     if(isset($_SESSION['role'])){
          
            header("Location: userDetails.php");
     }else{
             header("Location: profileMng.php");
     }




  }
}else{
    header("Location: login.php");
}



 //delete user  functionality for only the admin
 //condition checks for the role to be set
 if(isset($_SESSION['role'])){
  if(isset($_POST['delete'])){

     $id = $_POST['id'];
     $delete = "DELETE FROM users WHERE Id = ? ";
     $stmt = $mysqli ->prepare($delete);
     $stmt ->bind_param("i", $id);
     $stmt->execute();
     if($stmt->execute() === true){
       $_SESSION['message'] = "User Deleted";
       $stmt->close();
     }else{
        $_SESSION['message'] = "Failed to Delete user!";
        $stmt->close();
     }

     header("Location: userDetails.php");
   }
 }else{
     Session_destroy();
    header("Location: login.php");
 }


 ?>

 <?php
 if(isset($_POST['register'])){

   //striping the input data of the tags
             $username = strip_tags($_POST['username']);
             $email = strip_tags($_POST['email']);
            $role = strip_tags($_POST['role']);
             $password = strip_tags($_POST['password']);
             $cpassword = strip_tags($_POST['confirmpassword']);

            //striping the slaches
             $username =  stripslashes($username);
             $email =stripslashes($email);
             $role = stripslashes($role);
             $password =  stripslashes($password);
             $cpassword =  stripslashes($cpassword);

             $username = mysqli_real_escape_string($mysqli, $username);
            $email = mysqli_real_escape_string($mysqli, $email);
          $role = mysqli_real_escape_string($mysqli, $role);
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
                     $query = "INSERT INTO users (UserName, EmailAddress, Password, role,  avatar) VALUES (?, ?, ?, ?, ?)";
                       $stmt = $mysqli -> prepare ($query);
                     $stmt ->bind_param("sssss",   $username , $email, $password, $role,  $avatar_path );
                      $stmt->execute();
                     if($stmt->execute() === true){
                       $_SESSION['message'] = 'Successfuly registered ';
                       $stmt->close();

                             header("Location: userDetails.php");


                     }else{
                       $_SESSION['message'] = "Failed to add $username ";
                     }


                   }else{
                       $_SESSION['message'] = "Failed to upload image ";
                   }

                 }else{
                     $_SESSION['message'] = "Please only uploag a GIF, JPG, PNG images";
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


           <a class ="active" href="admin.php">Admin-Home</a>
           <a  href="userDetails.php">userDetails</a>
            <a href="logout.php">Logout</a>

     </nav>
   </header>
   <h1>Sign-Up-NewUser</h1>


     <div class="main-body-Form">
      <form id="userForm" action="userMng.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <h1>newUser-Account</h1>

             <div class="alert alert-error"></div>
             <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
             <input type="text" placeholder="User Name" name="username" required /><div>
             <input type="email" placeholder="Email" name="email" required /><div>
             <input type="password" placeholder="Password" name="password" autocomplete="new-password" required /><div>
             <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required /><div>
                 <input type="text" placeholder="User-Role(keep blank if regular user)" name="role"  /><div>
             <div class="avatar"><label>avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
             <input type="submit" value="Register" name="register"/>
             <input type="reset" value="Register" name="reset"/>

      </form>
    </div>


        <div class="footer">

         <footer id="cpright" >   copyrights Arsalan Khan And Hasib Aziz ..... 2018   </footer>

      </div>

 </body>
 </html>
