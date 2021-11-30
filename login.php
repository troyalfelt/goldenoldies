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


<?php if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT email, fname, lname, password, user.role_name, access_lvl FROM user, roles WHERE user.role_name = roles.role_name AND email='$email' AND password='$password' AND approved=1";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    while($row == $result->fetch_assoc()) {
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
      $_SESSION['role_name'] = $row['role_name'];
      $_SESSION['access_lvl'] = $row['access_lvl'];
      echo 'Welcome, ' . $_SESSION['name'] . '<br/>';

    }

  } else {
    echo 'Incorrect username/password';
  }
}
?>
<?php
  if (isset($_SESSION['access_lvl'])) {
    echo $_SESSION['access_lvl'];
  } else {
    echo 'no lcuk';
  }?>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="container">
  <form class="f-login" action='<?php echo $_SERVER['PHP_SELF']; ?>' method="post">
  <h1>Login</h1>
    <hr>
    <label for="email"><b>Email</b></label><br>
    <input id="email" name="email" type="text" placeholder="Enter Your Email" class="textbox"/></br></br>
    <label for="password"><b>Password</b></label><br>
    <input id="password" name="password" type="password" placeholder="Enter Your Password" class="textbox"/></br></br>
    <input type="submit" name="submit" class="btn" value="Sign In"></br></br>
  </form>
</div>
<footer>
    <h3>Contact Us</h3>
    <a href='admin/roles.php'/>roles</a>
    <p>000-000-0000</p>
</footer>
</body>
</html>
