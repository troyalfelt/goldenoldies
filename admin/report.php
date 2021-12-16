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
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Reports</title>
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
              <a href="new-roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">New Roster</a>
              <a href="roles.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles</a>
              <a href="payment.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Payment</a>
              <a href="../roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roster</a>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
        </div>
      </div>
    </div>
</nav>

<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <h1 class="text-gray-900 text-5xl">Admin's Report</h1>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="p-4 shadow-md rounded-md text-left">
                    <form action="" method="post">
                        <div>
                            <label class="block mt-4">
                            <span class="text-gray-700">Date</span>
                            <input type="date" id="date" name="date" class="form-select mt-1 block w-full">
                            </label>
                        </div>
                        <div>
                          <input type='submit' name='submit' value='Check Date'>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <h2 class="text-gray-900 text-5xl">Missed Activity</h2>
        <?php if (isset($_POST['submit'])) {
          $date = $_POST['date'];
          $today = date('Y-m-d');
          $dr_name;
          //checks if its happened yet
          if ($date < $today) {
          //checks for the doctor that day
          $dr_check = "SELECT r.dr_id, CONCAT(u.fname, ' ', u.lname) as dr_name FROM roster r, user u WHERE r.date ='$date' AND u.user_id = r.dr_id";
          $dr_on = $conn->query($dr_check);
            if ($dr_on->num_rows > 0) {
              while ($row = $dr_on->fetch_assoc()) {
                $dr_name = $row['dr_name'];
              }
            } else {
              $dr_name = 'No doctor assigned';
            }
          echo "<div>
                  <div>Date: " . $date . "</div>
                  <div>Doctor on Duty: " . $dr_name . '</div></div>';
          $sql = "SELECT rt.patient_id, rt.morn_status, rt.aft_status, rt.night_status, rt.breakfast, rt.lunch, rt.dinner, rt.dr_appt,
          CONCAT(u.fname, ' ', u.lname) AS patient_name
          FROM routine rt, user u WHERE rt.date='$date' AND rt.patient_id=u.user_id AND
          (rt.morn_status = 0 OR rt.aft_status = 0 OR rt.night_status = 0 OR rt.breakfast = 0 OR rt.lunch = 0 OR rt.dinner = 0 or rt.dr_appt = 0)";
          $result=$conn->query($sql);
          //checks if it there's a routine set for that day
          if ($result->num_rows > 0) {
            //makes table & head
            echo '<table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50"><tr><th>Patient Name</th><th>Morning Med</th><th>Afternoon Med</th><th>Night Med</th>
                      <th>Breakfast</th><th>Lunch</th><th>Dinner</th><th>Doctor Appointment</tr></thead><tbody>';
            while ($row = $result->fetch_assoc()) {
              $patient_id = $row['patient_id'];
              $patient_name = $row['patient_name'];
              $morn_status = $row['morn_status'];
              $aft_status = $row['aft_status'];
              $night_status = $row['night_status'];
              $breakfast = $row['breakfast'];
              $lunch = $row['lunch'];
              $dinner = $row['dinner'];
              $dr_appt = $row['dr_appt'];
              echo '<tr><td>' . $patient_name . "</td>";
              if ($morn_status == 0) {
                echo "<td>Incomplete</td>";
              } elseif ($morn_status == 1) {
                echo "<td>Completed</td>";
              } else {
                echo "<td>None assigned</td>";
              }
              if ($aft_status == 0) {
                    echo "<td>Incomplete</td>";
              } elseif ($aft_status == 1) {

                echo "<td>Completed</td><";
              } else {

                echo "<td>None assigned</td>";
              }

              if ($night_status == 0) {
                  echo "<td>Incomplete</td>";
              } elseif ($night_status == 1) {
                echo "<td>Completed</td>";
              } else {
                echo "<td>None assigned</td>";
              }
              if ($breakfast == 0) {
                  echo "<td>Incomplete</td>";
              } elseif ($breakfast == 1) {
                echo "<td>Completed</td>";
              }
              if ($lunch == 0) {
                  echo "<td>Incomplete</td>";
              } elseif ($lunch == 1) {
                echo "<td>Completed</td>";
              }
              if ($dinner == 0) {
                  echo "<td>Incomplete</td>";
              } elseif ($dinner == 1) {
                echo "<td>Completed</td>";
              }
              if ($dr_appt == 0) {
                  echo "<td>Incomplete</td>";
              } elseif ($dr_appt == 1) {
                echo "<td>Completed</td>";
              } else {
                echo "<td>None assigned</td>";
              }
            }
            //close table
            echo "</tbody></table>";
          } else {
            //if theres no routine that day
            echo 'No routine set for that day';
          }
        } else {
          //if its a future date
          echo '<h2>Please choose a past date</h2>';
        }
        }?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
