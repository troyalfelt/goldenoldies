<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
<?php if (isset($_POST['submit'])) {
  $approved = $_POST['approved'];

  $sql = "INSERT INTO user (approval) VALUES ('$approved')";

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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Approval</th>
        </tr>
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

$sql = "SELECT fName, lName, role_name FROM user";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>". $row["fName"]. "</td><td>" . $row["lName"]. "</td><td>". $row["role_name"]. "</td></tr>";
}
}
$conn->close();
?>
<td></td>
<td></td>
<td></td>
<td><form action="" method="post" class="">Yes
  <input type="checkbox" name="approved" value="1"/>No
    <input type="checkbox" name="approved" value="0"/>
</td>
</tr>
</table>
    <input type="submit" class="btn" name="submit" value="Okay">
    <input type="reset" class="btn" name="submit" value="Cancel">
  </form>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>
