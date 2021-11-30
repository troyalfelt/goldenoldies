<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] > '4') {
    header("Location: ../login.php");
}
}
?>

list of patients
