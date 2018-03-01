<?php

     //this is the file for the database connector
     include_once('ConnectorDb.php');

       if($_SERVER["REQUEST_METHOD"] == "POST")
       {
            //striping the input data of the tags
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $cpassword = strip_tags($_POST['cpassword']);

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

            //query to insert into the table
            $insert = "INSERT INTO users (UserName, EmailAddress, Password) values (?, ?, ?)";

            //query to select from the users  to check if there is a user
          //  $selectUser = "SELECT * FROM users WHERE UserName ='$username' ";
            //query to select from the users  to check if there is a email tha exists
          //  $selectEmail = "SELECT * FROM users WHERE EmailAddress ='$email' ";

            //now actually fetch the query for the user
            //$queryUser = mysqli_query($mysqli, $selectUser);
            //now actually fetch the query for the user
        //   $queryEmail = mysqli_query($mysqli, $selectEmail);
           //fetching query

           //$rowEmail = mysqli_fetch_array($queryUser);

            // if the query is tru then we know that there is already a user with that name
            //if(mysqli_num_rows($rowUser)){

                //  echo "User Exists";
                //  return;
          //  }
            //check if email exists
          //  if(mysqli_num_rows($rowEmail)){
            //   echo "Email Exists";
          //  //   return;
            //}
            if($password == $cpassword){
              $stmt = $mysqli -> prepare ($insert);

              $stmt ->bind_param("sss",   $username , $email, $cpassword );
              $stmt->execute();
              $stmt->close();

            }else{
              echo "Password Mismatch!!";
              return;
            }
            $Select = "SELECT * FROM users WHERE UserName = '$username' LIMIT 1";
              $result2 = mysqli_query($mysqli, $Select);
            if((mysqli_num_rows($result2) > 0)){
              while($row = $result2->fetch_assoc()){
                $userId = $row['Id'];
              $status = 1;
              //  $pInsert = "INSERT INTO pimg (userId, status)  VALUES ('$userId', 1) ";
                $stmt2= $mysqli -> prepare ( "INSERT INTO pimg (userId, status)  VALUES (?, ?) ");
                $stmt2->bind_param("ii",   $userId, $status);
                $stmt2->execute();
                $stmt2->close();


              }



                  header("location: index.php");
            }


       }
 ?>
<html>

    <head>
      <meta charset="UTF-8">
      <title>Register</title>
      <link href="app.css" rel="stylesheet" type="text/css" >
      <meta character="UTF-8">
    </head>

    <body>

      <div class="navigation">

                  <header>

                    <nav id="globalnav">

                      <a href="index.php">Home</a>
                        <a href="login.php">Login</a>
                        <a  class="active"  href="registration.php">Sign-Up</a>



                    </nav>
                  </header>
      </div>

      <h1>Sign-Up</h1>

    <div class="main-body-Form">
     <form id="userForm" action="registration.php" method="post">

          UserName:<br>
            <input type="text" name="username" required/><br>
          E-mail:<br>
              <input type="text" name="email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid Email!!!"  required/><br>
          Password:<br>
          <input type="password" name="password"  required/><br>
          Confirm-Password:<br>
          <input type="password" name="cpassword"  required/><br>
          <input type="submit" name="submit" value="register" />
          <input type="reset" value="reset" /><br>

            <p>Already have an account? <a id = "login" href="login.php">Login here</a></p>
     </form>
   </div>

    <div class="footer">
     <footer id="cpright" >copyrights Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>

    </body>


</html>
