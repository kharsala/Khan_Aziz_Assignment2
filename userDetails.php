<html>

  <head>
      <meta charset="UTF-8">
      <link href="app.css" rel="stylesheet" type="text/css" >
  </head>

  <body>
      <div class="navigation">
                  <header>

                    <nav id="#ac-globalnav">

                        <a href="newUser.php">New-User</a>
                        <a href="Admin.php">My-Page</a>
                        <a href="index.php">Logout</a>
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

                          echo "<tr>";
                              echo "<td>" . $row['Id'] . "</td>";
                              echo "<td>" . $row['UserName'] . "</td>";
                              echo "<td>" . $row['EmailAddress'] . "</td>";
                              echo'<td>
                                <form action="userDetails.php" method = "POST" >
                                  <input type = "submit" value="SELECT">
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
