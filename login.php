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
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="login">
  <form action="" method="post">
    <h1>Login</h1>
    <hr>
    <label for="email"><b>Email</b></label><br>
    <input id="email" name="email" type="text" placeholder="Enter Your Email" class="textbox"/></br></br>
    <label for="password"><b>Password</b></label><br>
    <input id="password" name="password" type="password" placeholder="Enter Your Password" class="textbox"/></br></br>
    <input type="submit" class="btn" value="Sign In"></br></br>
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