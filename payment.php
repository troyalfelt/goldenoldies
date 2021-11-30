<?php
  session_start();
  if (!isset($_SESSION['access_lvl'])) {
    header("Location: ../login.php");
  } else {
    if ($_SESSION['access_lvl'] !== '1') {
      header("Location: ../login.php");
  }
}
?>
Payment page
