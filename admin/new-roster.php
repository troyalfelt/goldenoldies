<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] > '2') {
    header("Location: ../login.php");
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Roster</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="new-roster">
  <div>

  </div>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>
