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
  <style>
      * {
      box-sizing: border-box;
    }
    body {
      display: flex;
      flex-direction: column;
      align-content: space-between;
      align-items: center;
    }
    header {
      background-color: #7fffd4;
      width: 100%;
    }
    footer {
      background-color: #C0C0C0;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }
  </style>
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
  $sql = "SELECT email, password FROM user WHERE email='$email' AND password='$password' AND approved=1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 'Login Successful';
  } else {
    echo 'Incorrect username/password';
  }
}
?>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="login">
  <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="post">
    <input type="text" name="email" placeholder="email">
    <input type="text" name = "password" placeholder="password">
    <input type="submit" name="submit">
  </form>
  <div>

  </div>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>
