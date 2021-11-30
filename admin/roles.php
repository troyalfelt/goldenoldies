<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
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
  <title>New Roles</title>
  <link rel="stylesheet" type="text/css" href="../styles.css"/>
</head>

<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>

  <?php
  if (isset($_POST['submit'])) {
  $role = $_POST['role'];
  $access = $_POST['access'];
  $sql = "INSERT INTO roles (role_name, access_lvl)/*roles (role, access)*/ VALUES ('$role', '$access')";


  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
  <div class="container">
      <table>
        <tr>
            <th>Role</th>
            <th>Access Level</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <form action="" method="post" class="">
        <label for="role"><b>New Role</b></label><br>
        <input type="text" placeholder="Enter Role" name="role" id="role" required><br>
        <label for="accsess"><b>Access Level</b></label><br>
        <input type="text" placeholder="Enter Access Level" name="access" id="access" required><br>
        <input type="submit" class="btn" name="submit" value="Okay">
    </form>
  </div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>
