<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '1') {
    header("Location: ../login.php");
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Approval</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
 ?>


<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
  <div class="container">
  <h2>Registration Approval</h2>
  <table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
    </tr>
  <?php
  if (isset($_POST['submit']))  {
        $user_id = $_POST['user_id'];

        if ($_POST['status'] == 'approved') {
          $qry = "UPDATE user SET approved = 1 WHERE user_id= '$user_id'";
          $rslt = $conn->query($qry);
          echo 'User approved';
          } else {
            $qry = "DELETE FROM user WHERE user_id= '$user_id'";
            $rslt = $conn->query($qry);
            if ($rslt == TRUE) {
              echo "User deleted";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
          }
}
?>
<?php

    $sql = "SELECT user_id, fname, lname, role_name FROM user WHERE approved = 0 ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?><tr>
            <?php echo "<td>" . $row["fname"] . "</td>"?>
            <?php echo "<td>" . $row["lname"] . "</td>"?>
            <?php echo "<td>" . $row["role_name"] . "</td>"?>
            <td>
              <form action='' method='post' name='approved'>
                <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                <input type='hidden' name='status' value='approved'>
                <input type='submit' name='submit' value='Approve'>
                </form>
            </td>
            <td>
              <form action='' method='post' name='disapproved'>
                <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                <input type='hidden' name='status' value='disapproved'>
              <input type='submit' name='submit' value='Disapprove'>
              </form>
            </td>
          </tr>
<?php }
  }
  ?>
        </div>
        <footer>
        <script>  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
            <h3>Contact Us</h3>
            <p>000-000-0000</p>
        </footer>
        </body>
        </html>
