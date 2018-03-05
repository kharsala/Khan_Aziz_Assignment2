<?php
session_start();
include_once("ConnectorDb.php");
//current user id
$id = $_SESSION['id'];
if(!isset($id)){
  header("Location: loging.php");
}
if(isset($_POST['upload'])){
  $file = $_FILES['file'];

  //take information on the file
  $fileName = $_FILES['file']['name'];
  $fileTempName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError =$_FILES['file']['error'];
  $fileType =$_FILES['file']['type'];

  //  take apart the name and get anarray
  $fileExt = explode('.', $fileName);
  //aleays put it to lower case
  $fileActualExt = strtolower(end($fileExt));
  //which files to allow
  $allow = array('jpg', 'jpeg', 'png', 'gif');
  //if file is allowed or not depending on extention
  if(in_array($fileActualExt, $allow)){
    // to check if their is any error
    if($fileError === 0){
        if($fileSize < 500000){
            //now we can upload the file after all the checks
            //creating a unique id for each image
            $filenewName = "default".$id.".".$fileActualExt;
            //add this to root folder of the projects
            $fileDestination = '../images/ ' .$filenewName;
            //actual functiont to move the file to actual location
            move_uploaded_file($fileTempName, $fileDestination);
            //update the status of the upload
            $sql = "UPDATE pimg SET status= 0 WHERE userId ='$id' ";
            $result = $mysqli->query($sql);
            header("Location: profileMng.php?uploadsucess");

        }else{
          echo"to large for upload";
        }
    }else{
      echo "error while uploading";
    }
  }else {
    echo "Can not upload this type of file";
  }
}



?>
