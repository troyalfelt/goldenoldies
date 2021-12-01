<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_start();
//if (!isset($_SESSION['access_lvl'])) {
  //header("Location: ../login.php");
//} else {
  //if ($_SESSION['access_lvl'] > '2') {
    //header("Location: ../login.php");
//}
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>New Roster</title>
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
$supervisor = $_POST['supervisor'];
$doctor = $_POST['doctor'];
$caregiver1 = $_POST['caregiver1'];
$caregiver2 = $_POST['caregiver2'];
$caregiver3 = $_POST['caregiver3'];
$caregiver4 = $_POST['caregiver4'];
$sql = "INSERT INTO roster (date, supervisor_id, dr_id, caregiver1_id, caregiver2_id, caregiver3_id, caregiver4_id)
        VALUES('$date', '$supervisor', '$doctor', '$caregiver1', '$caregiver2', '$caregiver3', '$caregiver4')";
$result = $conn->query($sql);
if ($result == TRUE) {
  echo 'New roster created for ' . $date;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
?>
<body>
<header>
    <h1>Golden Oldies</h1>
</header>
<div class="new-roster">
<div>
  <form action="" method="post" class="">
    <label for="date"><b>Date of Roster</b></label>
    <input type="date" name="date" id="date" required><br><br>
    <label for="supervisor"><b>Select Supervisor</b></label>
    <?php
    $query = "SELECT user_id, CONCAT(fname, ' ', lname) AS full_name FROM user WHERE role_name = 'Supervisor' AND approved=1";
    $Supervisor = $conn->query($query);
    $arr = [];
    if ($Supervisor->num_rows > 0) {
    // output data of each row
    while($row = $Supervisor->fetch_assoc()) {
      $arr[$row['user_id']] = $row['full_name'];
    }
  }
    ?>
    <select id="supervisor" name="supervisor" required>
      <option value=''>Select a Supervisor</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>

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
      <option value=''>Select a Doctor</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>

    <label for="caregiver1"><b>Select Caregiver 1</b></label>
    <?php
    $query = "SELECT user_id, CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Caregiver' AND approved=1";
    $Caregiver1 = $conn->query($query);
    $arr = [];
    if ($Caregiver1->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver1->fetch_assoc()) {
      $arr[$row['user_id']] = $row['full_name'];
    }
  }
    ?>
    <select id="caregiver1" name="caregiver1" required>
      <option value=''>Select a Caregiver</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>

    <label for="caregiver2"><b>Select Caregiver 2</b></label>
    <?php
    $query = "SELECT user_id, CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Caregiver' AND approved=1";
    $Caregiver2 = $conn->query($query);
    $arr = [];
    if ($Caregiver2->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver2->fetch_assoc()) {
      $arr[$row['user_id']] = $row['full_name'];
    }
  }
    ?>
    <select id="caregiver2" name="caregiver2" required>
      <option value=''>Select a Caregiver</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>



    <label for="caregiver3"><b>Select Caregiver 3</b></label>
    <?php
    $query = "SELECT user_id, CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Caregiver' AND approved=1";
    $Caregiver3 = $conn->query($query);
    $arr = [];
    if ($Caregiver3->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver3->fetch_assoc()) {
      $arr[$row['user_id']] = $row['full_name'];
    }
  }
    ?>
    <select id="caregiver3" name="caregiver3" required>
      <option value=''>Select a Caregiver</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>



    <label for="caregiver4"><b>Select Caregiver 4</b></label>
    <?php
    $query = "SELECT user_id, CONCAT(fname, ' ', lname) as full_name FROM user WHERE role_name = 'Caregiver' AND approved=1";
    $Caregiver4 = $conn->query($query);
    $arr = [];
    if ($Caregiver4->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver4->fetch_assoc()) {
      $arr[$row['user_id']] = $row['full_name'];
    }
  }
    ?>
    <select id="caregiver4" name="caregiver4" required>
      <option value=''>Select a Caregiver</option>
      <?php
        foreach($arr as $r => $r_value) {
          echo "<option value='$r'>$r_value</option>";
        }
       ?>
    </select><br><br>


    <input type="submit" class="btn" name="submit" value="Okay">
    <input type="reset" class="btn" name="submit" value="Cancel">
</form>
</div>
</div>
<footer>
  <h3>Contact Us</h3>
  <p>000-000-0000</p>
</footer>
</body>
</html>
