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
    form {
      background-color: #7fffd4;
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 400px;
    }
    footer {
      background-color: #C0C0C0;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }
    .login {
      background-color: #f0ffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-around;
      height: 590px;
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
<<<<<<< HEAD
    <input type="text" name="email" placeholder="email"/>
    <input type="text" name = "password" placeholder="password"/>
    <input type="submit" name="submit"/>
=======
  <h1>Login</h1>
    <hr>
    <label for="email"><b>Email</b></label><br>
    <input id="email" name="email" type="text" placeholder="Enter Your Email" class="textbox"/></br></br>
    <label for="password"><b>Password</b></label><br>
    <input id="password" name="password" type="password" placeholder="Enter Your Password" class="textbox"/></br></br>
    <input type="submit" name="submit" class="btn" value="Sign In"></br></br>
>>>>>>> de2dd4203dc5cad0e7df3f6420463aabffa6ff9d
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
