<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
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
    a {
      background-color: #00ffff;
      border-radius: 5px;
      color: black;
      font-size: 44pt;
      text-decoration: none;
    }
    a:hover {
      color: #C0C0C0;
    }
    footer {
      background-color: #C0C0C0;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }
    .home {
      background-color: #f0ffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-around;
      height: 590px;
      width: 100%;
    }
    .link {
      align-items: center;
      display: flex;
      flex-direction: column;
      height: 100px;
      width: 200px;
    }
  </style>
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="home">
  <div class="link"><a href="login.php">Login</a></div>
  <div class="link"><a href="register.php">Register</a></div>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>