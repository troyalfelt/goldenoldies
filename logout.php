<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
<?php
  session_start();
  $_SESSION['user_id'] = '';
  $_SESSION['email'] = '';
  $_SESSION['name'] = '';
  $_SESSION['role_name'] = '';
  $_SESSION['access_lvl'] = '';
  $_SESSION['fcode'] = '';
  $_SESSION['temp_code'] = '';
  header("Location: login.php");
  ?>
