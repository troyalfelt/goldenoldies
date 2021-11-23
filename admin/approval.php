<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '1') {
    header("Location: ../login.php");
}
}

echo $_SESSION['access_lvl'];
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
        <th>Approved</th>
    </tr>
  <?php
  if (isset($_POST['submit']))  {
        $approved = $_POST['approved'];

   $sql = "UPDATE user SET approved='1' WHERE approved=$approved";

   if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
   } else {
    echo "Error updating record: " . $conn->error;
   }

   $conn->close();
}
?>
<?php
    $servername = "localhost";
    $username = "troyalfelt";
    $password = "";
    $db = "test";

     //Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);
     //Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT fname, lname, role_name FROM user WHERE approved = 0 ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>". $row["fname"]. "</td><td>" . $row["lname"]. "</td><td>". $row["role_name"]. "</td><td><input type='checkbox' name='approved' value='".$row["approved"]."' >";
}
    }

    $conn->close();
  ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
          <form method = "post" action = "">
                <input type="hidden" name="approved" value="approved">
        </tr>
        </table>
            <input type="submit" class="btn" name="submit" value="Okay">
          </form>
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
