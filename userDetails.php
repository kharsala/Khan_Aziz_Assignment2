<?php
//make sure user is loged in as admin
session_start();
  if(!isset($_SESSION['role'])){

      header("Location: login.php?PleaseLogin");
  }
  $role = $_SESSION['role'];
 ?>
<html>

  <head>
      <meta charset="UTF-8">
      <link href="app.css" rel="stylesheet" type="text/css" >
  </head>

  <body>

      <div class="navigation">
                  <header>

                    <nav id="globalnav">

                              <a href="admin.php">Admin-Home</a>
                              <a   class ="active" href="userDetails.php">userDetails</a>
                               <a href="logout.php">Logout</a>

                    </nav>

                  </header>
      </div>
      <?php

               include_once('ConnectorDb.php');

                  $result = $mysqli->query("SELECT Id, UserName, EmailAddress FROM users");
                  echo "<h1>User Detail</h1>" ;
                  if ($result->num_rows > 0) {
                    echo "<table id='users-table'>";
                          echo "<tr>";
                                echo "<th>id</th>";
                                echo "<th>UserName</th>";
                                echo "<th>Email</th>";
                                echo "<th>Edit-User</th>";
                          echo "</tr>";
                  // output data of each row
                  while($row = $result->fetch_assoc()){
                    $id =  $row['Id'];
                    $username = $row['Id'];
                          echo "<tr>";
                              echo "<td>" . $row['Id'] . "</td>";
                              echo "<td>" . $row['UserName'] . "</td>";
                              echo "<td>" . $row['EmailAddress'] . "</td>";
                              echo'<td>
                                <form action="userMng.php" method = "POST" >
                                  <input type = "hidden" name = "id" value="'.$id.'">
                                    <input type = "hidden" name = "user" value="'.$username.'">
                                  <input type = "submit" value="edit" name="editform">
                                  <input type = "submit" value="Delete" name="delete">
                                  <input type = "submit" value="newUser" name="usercreate">
                                </form>
                              </td>';
                          echo "</tr>";



                  }
                   echo "</table>";
                }
                else {

                    echo "0 results";
                }
                $mysqli->close();
      ?>
      <div class="footer">
                <footer id="cpright" >copyrights Arsalan Khan And Hasib Aziz ..... 2018</footer>
      </div>
    </body>

</html>
