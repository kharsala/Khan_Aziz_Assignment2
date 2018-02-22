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

                        <a href="registration.php">New-User</a>
                        <a href="index.php">List-Users</a>
                    </nav>

                  </header>
      </div>

      <h1>New-User</h1>
    <div>
     <?php
          //variables that hold regex for validation
           $reg_name = "/^[a-zA-Z ]*$/";
           $reg_email="/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
          // $reg_code ="/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/";
           //$reg_phone ="/\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";
           //variables hold the array of words to be removed from address and bio fields
           //$sql_keywords = array("select", "insert", "update", "delete", "#", "--");
          // $sql_replace = array("choose","place","improve","cut", "", "");

           //when landing on the page cheks if form has been submited
          if(isset($_POST['submit']))
          {
            //data entered in the form on newUser.php page
            if((string)preg_match($reg_name, $_POST['name']))
              $user = strip_tags(trim($_POST['name'] ));

            if(preg_match($reg_email, $_POST['email']))
              $email = strip_tags(trim( $_POST['email']));
              
              if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
                  $password = test_input($_POST["password"]);
                  $cpassword = test_input($_POST["cpassword"]);
                  if (strlen($_POST["password"]) <= '8') {
                      $passwordErr = "Your Password Must Contain At Least 8 Characters!";
                  }
                  elseif(!preg_match("#[0-9]+#",$password)) {
                      $passwordErr = "Your Password Must Contain At Least 1 Number!";
                  }
                  elseif(!preg_match("#[A-Z]+#",$password)) {
                      $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
                  }
                  elseif(!preg_match("#[a-z]+#",$password)) {
                      $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
                  }
              }
              elseif(!empty($_POST["password"])) {
                  $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
              } else {
                   $passwordErr = "Please enter password   ";
              }




          }
            //variable that hold database information
            $dbhost = 'localhost' ;
            $username = 'root' ;
            $password = '';
            $database = 'users' ;

            //creating connection to the database
            $mysqli = new mysqli("$dbhost", "$username", "$password", "$database");
            if($mysqli->connect_error){
               die("Connection Failed" . $conn->connect_error);
            }
            else{
              echo "Connection Successful" . "<br>" ;
            }

            //sql query to insert form data into database table (userTable)
            $sql = "insert into user (UserName, EmailAddress, Password)
            Values ('$user', '$email', '$address', '$code', '$phone', '$bio')";

            if (mysqli_query($mysqli, $sql)) {
              echo "New record created successfully";
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
            }
          }



      ?>
    </div>


    <div class="main-body-Form">
     <form id="userForm" action="newUser.php" method="post">

          UserName:<br>
          <input type="text" name="name" pattern="[a-zA-Z]{1,15}" title ="UserName should only contain letters e.g KHAN or khan" required/><br>
          E-mail:<br>
          <input type="text" name="email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid Email!!!" required/><br>
          Password:<br>
          <input type="password" name="password" required/><br>
          retype-Password:
              <input type="password" name="rpassword" required/><br>
          <input type="submit" name="submit" value="register" />

     </form>
     <div>

    <div class="footer">
     <footer id="cpright" >copyrights Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
    </body>


</html>
