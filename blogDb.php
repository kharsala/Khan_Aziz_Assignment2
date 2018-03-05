<?php

$dbhost = 'localhost' ;
$username = 'root' ;
$dbpassword = '';
$database = 'blog' ;

//creating connection to the database
//$mysqli
$mysqli = mysqli_connect("$dbhost", "$username", "$dbpassword", "$database");

if($mysqli->connect_error){
   die("Connection Failed" . $conn->connect_error);
}


?>
