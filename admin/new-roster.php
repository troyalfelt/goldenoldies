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
  <link rel="stylesheet" type="text/css" href="../styles.css">
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
<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>New Roster</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="admin.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Home</a>
              <a href="appt.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Appointments</a>
              <a href="approval.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Approval</a>
              <a href="employee.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Employees</a>
              <a href="info.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patient Info</a>
              <a href="report.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Report</a>
              <a href="roles.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles</a>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
        </div>
      </div>
    </div>
</nav>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
  <h1 class="text-gray-900 text-5xl">New Roster</h1>
    <div class="p-4 shadow-md rounded-md text-left">
      <form action="" method="post">
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Date</span>
            <input type="date" id="date" name="date" class="form-select mt-1 block w-full">
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Supervisor</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Doctor</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Caregiver 1</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Caregiver 2</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Caregiver 3</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
        <div>
          <label class="block mt-4">
            <span class="text-gray-700">Caregiver 4</span>
            <select class="form-select mt-1 block w-full">
              <option>None</option>
            </select>
          </label>
        </div>
      </form>
    </div>
    <div>
      <form class="mt-8 space-y-6" action="" method="POST">
        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Submit
          </button>
        </div>
        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>

<!--Add any below to the HTML above
<div class="new-roster">
<div>
  <form action="" method="post" class="">
    <label for="date"><b>Date of Roster</b></label>
    <input type="date" name="date" id="date" required><br><br>
    <label for="supervisor"><b>Select Supervisor</b></label>
    <?php
    /*$query = "SELECT user_id, CONCAT(fname, ' ', lname) AS full_name FROM user WHERE role_name = 'Supervisor' AND approved=1";
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
</div>*/
