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
$Supervisor = $_POST['Supervisor'];
$Doctor = $_POST['Doctor'];
$Caregiver1 = $_POST['Caregiver1'];
$Caregiver2 = $_POST['Caregiver2'];
$Caregiver3 = $_POST['Caregiver3'];
$Caregiver4 = $_POST['Caregiver4'];
$sql = "INSERT INTO roster (date ,supervisor_id, dr_id, caregiver1_id,caregiver2_id,caregiver3_id,caregiver4_id) VALUES ('$date', '$Supervisor', '$Doctor', '$Caregiver1', '$Caregiver2', '$Caregiver3', '$Caregiver4')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
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
    <label for="date"><b>Date of Birth</b></label>
    <input type="date" name="date" id="date"><br><br>
    <label for="Supervisor"><b>Select Supervisor</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Supervisor'";
    $Supervisor = $conn->query($query);
    $arr = [];
    if ($Supervisor->num_rows > 0) {
    // output data of each row
    while($row = $Supervisor->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="supervisor" name="Supervisor" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
    </select><br><br>

    <label for="Doctor"><b>Select Doctor</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Doctor'";
    $Doctor = $conn->query($query);
    $arr = [];
    if ($Doctor->num_rows > 0) {
    // output data of each row
    while($row = $Doctor->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="doctor" name="Doctor" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
    </select><br><br>

    <label for="Caregiver1"><b>Select Caregiver1</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Caregiver'";
    $Caregiver1 = $conn->query($query);
    $arr = [];
    if ($Caregiver1->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver1->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="caregiver1" name="Caregiver1" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
    </select><br><br>

    <label for="Caregiver2"><b>Select Caregiver2</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Caregiver'";
    $Caregiver2 = $conn->query($query);
    $arr = [];
    if ($Caregiver2->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver2->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="caregiver2" name="Caregiver2" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
    </select><br><br>



    <label for="Caregiver3"><b>Select Caregiver3</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Caregiver'";
    $Caregiver3 = $conn->query($query);
    $arr = [];
    if ($Caregiver3->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver3->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="caregiver3" name="Caregiver3" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
    </select><br><br>



    <label for="Caregiver4"><b>Select Caregiver4</b></label>
    <?php
    $query = "SELECT fname, lname FROM user WHERE role_name = 'Caregiver'";
    $Caregiver4 = $conn->query($query);
    $arr = [];
    if ($Caregiver4->num_rows > 0) {
    // output data of each row
    while($row = $Caregiver4->fetch_assoc()) {
      array_push($arr, $row['fname']);
    }
  }
    ?>
    <select id="caregiver4" name="Caregiver4" required>
      <?php
        foreach($arr as $r) { ?>
          <option><?php echo $r; ?> </option>
      <?php } ?>
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
