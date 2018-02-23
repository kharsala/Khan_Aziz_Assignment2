<?php
$dbhost = 'localhost' ;
$username = 'root' ;
$dbpassword = '';
$database = 'userdatabase' ;

//creating connection to the database
$mysqli = new mysqli("$dbhost", "$username", "$dbpassword", "$database");
if($mysqli->connect_error){
   die("Connection Failed" . $conn->connect_error);
}

?>
