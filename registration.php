<?php

     //this is the file for the database connector
     require_once 'ConnectorDb.php';
     //variables that hold regex for validation
      $reg_name = "/^[a-zA-Z ]*$/";
      $reg_email="/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
      $reg_pass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

      //defining variables username and password
      $user = $password = $confPassword = "";
      $user_err = $password_err = $conf_pass_err = "";

       $stmt = $mysqli -> prepare ("insert into users (UserName, EmailAddress, Password ) values (?,?,?) ");

       $stmt ->bind_param("sss", $user, $email, $password );
     //isset($_POST['submit'])
       if($_SERVER["REQUEST_METHOD"] == "POST")
       {
         //data entered in the form on newUser.php page
         if((string)preg_match($reg_name, $_POST['name']))
           $user = strip_tags(trim($_POST['name'] ));

         if(preg_match($reg_email, $_POST['email']))
           $email = strip_tags(trim( $_POST['email']));


           $password = trim($_POST['password']);

           $stmt->execute();
           $stmt->close();
          echo"New Record created Sucessfully";
        //  header("location: index.php");

         }
 ?>
<html>

    <head>
      <title>Register</title>
      <link href="app.css" rel="stylesheet" type="text/css" >
      <meta character="UTF-8">
    </head>

    <body>

      <div class="navigation">

                  <header>

                    <nav id="#ac-globalnav">

                          <a href="index.php">Home</a>
                        <a href="registration.php">Sign-up</a>

                    </nav>
                  </header>
      </div>

      <h1>Sign-Up</h1>

    <div class="main-body-Form">
     <form id="userForm" action="registration.php" method="post">

          UserName:<br>
          <input type="text" name="name" pattern="[a-zA-Z]{1,15}" title ="UserName should only contain letters e.g KHAN or khan" required/><br>
          E-mail:<br>
          <input type="text" name="email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid Email!!!" required/><br>
          Password:<br>
          <input type="password" name="password"  required/><br>
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
