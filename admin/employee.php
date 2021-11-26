<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
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
    <h2>Employee salary updated</h2>
  </div>
<div class="container">

  <h1>Employees</h1>
    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Salary</th>
      </tr>
      <tr>
        <td>Alfred</td>
        <td>Gellano</td>
        <td>Doctor</td>
        <td><form><input type='text' placeholder="500"/></td>
      </tr>
      <tr>
        <td>Alfred</td>
        <td>Gellano</td>
        <td>Caregiver</td>
        <td><form><input type='text' placeholder="0"/></td>
      </tr>

</div>
<footer>
    <h3>Contact Us</h3>
    <a href='admin/roles.php'/>roles</a>
    <p>000-000-0000</p>
</footer>
</body>
</html>
