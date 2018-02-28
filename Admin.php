<?php include('AdminOptions.php');

 //Start session
session_start();

include_once('ConnectorDb.php');

  if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($database, "SELECT * FROM users WHERE id=$id");
    $record = mysqli_fetch_array($rec);
    $username = $record['username'];
    $email = $record['email'];
    $password = $record['password'];
    $id = $recprd['id'];

  }


?>

<html >
<head>
    <title>Administration Page</title>
    <link href="app.css" rel="stylesheet" type="text/css" >

</head>
<body>

  <?php if (isset($_SESSION['message'])): ?>
      <div class="message">
        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
         ?>
      </div>
  <?php endif ?>
  <table>
        <h1>Welcome To Admin Page <?php echo $_SESSION['username'] ?> </h1>
        <thead>
          <tr>
            <th>Username</th>
            <th>E-Mail</th>
            <th>Password</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($results)){ ?>
            <tr>
              <td><?php echo $row['username'] ?> </td>
              <td><?php echo $row['email'] ?> </td>
              <td><?php echo $row['password'] ?> </td>
              <td>
                <a class="edit_btn" href="Admin.php?edit=<?php echo $row['id']; ?>">Edit</a>
              </td>
              <td>
                <a class="delete_btn href="AdminOptions.php?delete=<?php echo $row['id']; ?>">Delete</a>
              </td>
              <td>
                <a href="#">Approve</a>
              </td>
            </tr>
        <?php  } ?>


        </tbody>
      </table>

      <form method="post" action="AdminOptions.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
          <label>Username</label>
          <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
          <label>EmailAddress</label>
          <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="text" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
          <?php if ($edit_state == false): ?>
            <button type="submit" name="create" class="btn">Create User</button>
          <?php else: ?>
            <button type="submit" name="edit" class="btn">Edit</button>
            <?php endif; ?>

        </div>
      </form>



    <div class="footer">
     <footer id="cpright" >Copyrights of Arsalan Khan And Hasib Aziz ..... 2018</footer>
   </div>
</body>

</html>

//https://www.youtube.com/watch?v=mjVuBlwXASo
