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
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>
<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Doctor Appointments</title>
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
              <a href="approval.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Approval</a>
              <a href="employee.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Employees</a>
              <a href="info.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patient Info</a>
              <a href="new-roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">New Roster</a>
              <a href="report.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Report</a>
              <a href="roles.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles</a>
              <a href="payment.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Payment</a>

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
        <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Doctor Appointments
        </h2>
        <?php if (!empty($_POST['date'])) {
          $date = $_POST['date'];
          $sql = "SELECT roster.dr_id, user.user_id, user.fname, user.lname FROM roster, user WHERE roster.date='$date' AND roster.dr_id = user.user_id";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                  $dr_id = $row['dr_id'];
                  ?>
                  <form class="mt-8 space-y-6" name='appointment' action="" method='post'>
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                          <label for="appt_date"><b>Date: </b><?php echo $date; ?></label>
                            <?php echo "<input type='hidden' name='appt_date' value='$date'><br>"; ?>
                          </div>
                          <div>
                          <label for='dr_id' ><b>Doctor on duty: </b><?php echo $row['fname'] . ' ' . $row['lname'];?></label>
                            <?php echo "<input type='hidden' name='dr_id' value='$dr_id'><br>"; ?>
                          </div>
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
                      <span class="text-gray-700"><b>Patient</b></span><br>
                      <select id="role" name="patient_id" required>
                        <option class="form-select mt-1 block w-full" value=''>Select a patient</option>
                        <?php
                          foreach($arr as $r => $r_value) {
                             echo "<option class='form-select mt-1 block w-full' value='$r'>$r_value</option>";
                           } ?>
                      </select><br><br>
                      <input type='submit' name='create' value='Create Appointment' class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      </div>
                    </form>
          <?php  }
          } else {
            echo '<h3 class="text-gray-900 text-3xl">No roster set for ' . $date . '<br><a href="new-roster.php">Create one here</a></h3>';
          }
        } elseif (isset($_POST['dr_id'])) {
          $dr_id = $_POST['dr_id'];
          $date = $_POST['appt_date'];
          $patient_id = $_POST['patient_id'];
          $query2 = "INSERT INTO appointment (date, dr_id, patient_id) VALUES('$date', '$dr_id', '$patient_id')";
          $result2 = $conn->query($query2);
          if ($result2 == TRUE) {
            echo '<h3 class="text-gray-900 text-3xl">New appoinment set for ' . $date . '<br></h3>';
          } else {
            echo "Error: " . $query2 . "<br>" . $conn->error;
          }
          //enter appointment into patient routine
          $routine = "SELECT patient_id, date FROM routine WHERE patient_id = '$patient_id' AND date='$date'";
          $result = $conn->query($routine);
          if ($result->num_rows > 0) {
            //adjust the db
            $adjust = "UPDATE routine SET dr_appt = 0 WHERE patient_id = '$patient_id' AND date='$date'";
            $adjusted = $conn->query($routine);
          } else {
            $create = "INSERT INTO routine (patient_id, date, dr_appt)
                      VALUES ('$patient_id', '$date', 0)";
            $created = $conn->query($create);
          }
        }?>
        <div class="container">
          <div>
            <form action="" name='date' method="post" class="mt-8 space-y-6">
              <label for="date"><b>Select a Date</b></label>
              <input type="date" name="date" id="date" required id="appt_date" name="appt_date" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"><br>
              <input type='submit' name='find_date' value='Check Date'>
            </form>
        </div>
        </div>
        </div>
      </div>
    </div>
</div>


</body>
</html>
