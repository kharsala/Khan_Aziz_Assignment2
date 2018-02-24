

<?php
// Include config file
//require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
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
    // Validate credentials
    if(empty($user_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE UserName = ? AND Password = ?";
        //$stmt = $mysqli -> prepare ("SELECT UserName, Password FROM users where UserName = '$user' AND Password = '$password' ");
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_user, $param_password);

            // Set parameters
            $param_user = $username;
            $param_password = $password;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $user;
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Invalid Password Entered';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No User Account Exits';
                }
            } else{
                echo "Error: Please Try Again";
            }
        }

        // Close statement
      //  mysqli_stmt_close($mysqli);
    }

    // Close connection
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please Enter Credentials</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
        </form>
    </div>

    <div class="footer">
     <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
</body>

</html>
