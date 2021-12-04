<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
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
<title>Create Doctor's Appointments</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>
<header>
    <h1>Golden Oldies</h1>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>
<?php if (!empty($_POST['date'])) {
  $date = $_POST['date'];
  $sql = "SELECT roster.dr_id, user.user_id, user.fname, user.lname FROM roster, user WHERE roster.date='$date' AND roster.dr_id = user.user_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          $dr_id = $row['dr_id'];
          ?>
          <form name='appointment' action="" method='post'>
              <label for='appt_date'>Date: <?php echo $date; ?> </label> <br/>
              <?php echo "<input type='hidden' name='appt_date' value='$date'>"; ?>
              <label for='dr_id'>Doctor on duty: <?php echo $row['fname'] . ' ' . $row['lname'];?></label> <br/>
              <?php echo "<input type='hidden' name='dr_id' value='$dr_id'>"; ?>
              <?php
              $qry = "SELECT user_id, CONCAT(fname, ' ', lname) AS full_name FROM user WHERE role_name='Patient' AND approved=1";
              $patients = $conn->query($qry);
              $arr = [];
              if ($patients->num_rows == TRUE) {
              // output data of each row
              while($row = $patients->fetch_assoc()) {
                $patient_id = $row['user_id'];
                $full_name = $row['full_name'];
                $arr[$patient_id] = $full_name;
              }
            }
              ?>
              <select id="role" name="patient_id" required>
                <?php
                  foreach($arr as $r => $r_value) {
                     echo "<option value='$r'>$r_value</option>";
                   } ?>
              </select><br>
              <input type='submit' name='create' value='Create Appointment'>
            </form>
  <?php  }
  } else {
    echo '<h3>No roster set for that date</h3> . <br> . <a href="../admin/new-roster.php">Create one here</a>';
  }
} elseif (isset($_POST['dr_id'])) {
  $dr_id = $_POST['dr_id'];
  $date = $_POST['appt_date'];
  $patient_id = $_POST['patient_id'];
  $query2 = "INSERT INTO appointment (date, dr_id, patient_id) VALUES('$date', '$dr_id', '$patient_id')";
  $result2 = $conn->query($query2);
  if ($result2 == TRUE) {
    echo 'New appointment created for ' . $date;
  } else {
    echo "Error: " . $query2 . "<br>" . $conn->error;
  }
}
?>


<div class="container">
  <div>
    <form action="" name='date' method="post" class="">

      <label for="date"><b>Select a Date</b></label>

      <input type="date" name="date" id="date" required><br><br><br>
      <input type='submit' name='find_date' value='Check Date'>
    </form>
</div>
</div>
<footer>
  <h3>Contact Us</h3>
  <p>000-000-0000</p>
</footer>
</body>
</html>
