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
<title>Doctor's appointment</title>
<link rel="stylesheet" href="../styles.css">
</head>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>

<?php
if (isset($_POST['submit'])) {
$date = $_POST['date'];
$doctor = $_POST['doctor'];
$pa_id = $_POST['user_id'];
$sql = "INSERT INTO appointment (date, dr_id, patient_id)
        VALUES('$date', '$doctor', '$pa_id')";
        $result = $conn->query($sql);
        if ($result == TRUE) {
          echo 'New appointment created for ' . $date;
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        }
        ?>
<body>
<header>
    <h1>Golden Oldies</h1>
</header>

<div class="container">
  <div>
    <form action="" method="post" class="">

      <label for="user_id"><b>Input Patient Id</b></label>
  <input type="text" name="user_id" id="user_id" oninput="myfunction()"><br><br><br>
  <table>
    <th>Patient Name</th>
    <?php

        $sql = "SELECT  CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Patient' AND approved = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
         //output data of each row
        while($row = $result->fetch_assoc()) {
          ?><tr>
                <?php echo "<td>" . $row["full_name"] . "</td>"?>
            </tr>
          <?php }
        }
        ?>
  </table><br><br><br>



  <label for="date"><b>Date of Roster</b></label>
  <input type="date" name="date" id="date" required><br><br><br>

  <label for="doctor"><b>Select Doctor</b></label>
  <?php
  $query = "SELECT user_id, CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Doctor' AND approved=1";
  $Doctor = $conn->query($query);
  $arr = [];
  if ($Doctor->num_rows > 0) {
  // output data of each row
  while($row = $Doctor->fetch_assoc()) {
    $arr[$row['user_id']] = $row['full_name'];
  }
  }
  ?>
  <select id="doctor" name="doctor" required>
    <option value=''>Doctor On Roster</option>
    <?php
      foreach($arr as $r => $r_value) {
        echo "<option value='$r'>$r_value</option>";
      }
     ?>
  </select><br><br><br>



<input type="submit" class="btn" name="submit" value="Okay">
</div>
</div>
</form>
<footer>
  <h3>Contact Us</h3>
  <p>000-000-0000</p>
</footer>
</body>
</html>
