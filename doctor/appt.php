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

Doctor's appointment
