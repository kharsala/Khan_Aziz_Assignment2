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

                        <a href="registration.php">Sign-up</a>
                        <a href="index.php">Home</a>
                    </nav>

                  </header>
      </div>

      <h1>New-User</h1>
    <div>
     <?php
          //variables that hold regex for validation
           $reg_name = "/^[a-zA-Z ]*$/";
           $reg_email="/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
           $reg_pass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
          // $reg_code ="/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/";
           //$reg_phone ="/\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";
           //variables hold the array of words to be removed from address and bio fields
           //$sql_keywords = array("select", "insert", "update", "delete", "#", "--");
          // $sql_replace = array("choose","place","improve","cut", "", "");



            //variable that hold database information
            $dbhost = 'localhost' ;
            $username = 'root' ;
            $dbpassword = '';
            $database = 'userdatabase' ;

            //creating connection to the database
            $mysqli = new mysqli("$dbhost", "$username", "$dbpassword", "$database");
            if($mysqli->connect_error){
               die("Connection Failed" . $conn->connect_error);
            }
            $stmt = $mysqli -> prepare ("insert into users (UserName, EmailAddress, Password ) values (?,?,?) ");
            $stmt ->bind_param("sss", $user, $email, $password );

            if(isset($_POST['submit']))
            {
              //data entered in the form on newUser.php page
              if((string)preg_match($reg_name, $_POST['name']))
                $user = strip_tags(trim($_POST['name'] ));

              if(preg_match($reg_email, $_POST['email']))
                $email = strip_tags(trim( $_POST['email']));

                $password = $_POST['password'];



                $stmt->execute();
                echo"New Record created Sucessfully";
                $stmt->close();


              }


      ?>
    </div>


    <div class="main-body-Form">
     <form id="userForm" action="registration.php" method="post">

          UserName:<br>
          <input type="text" name="name" pattern="[a-zA-Z]{1,15}" title ="UserName should only contain letters e.g KHAN or khan" required/><br>
          E-mail:<br>
          <input type="text" name="email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid Email!!!" required/><br>
          Password:<br>
          <input type="password" name="password"  required/><br>

          <input type="submit" name="submit" value="register" /><br>

     </form>
     <div>

    <div class="footer">
     <footer id="cpright" >copyrights Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
    </body>


</html>
