<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '3') {
    header("Location: ../login.php");
}
}
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  <title>Doctors Home</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="home.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Home</a>
              <a href="../patients.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patients</a>
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
        <h1 class="text-gray-900 text-5xl">Doctor's Home</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th
                scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Comment
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Morning Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Afternoon Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Night Medicine
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      <a href="patient.php">Patient
                      </a>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <!-- More people... -->
          </tbody>
        </table>

        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="p-4 shadow-md rounded-md text-left">
                    <form action="" method="post">
                        <div>
                            <label class="block mt-4">
                            <span class="text-gray-700">Appointment Date</span>
                            <input type="date" id="date" name="date" class="form-select mt-1 block w-full">
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h2 class="text-gray-900 text-5xl">Appointments</h2>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<!--Add any code below to the HTML above-->

 <!-- <title><?php //echo $_SESSION['name']?>'s Home</title>
<h1>Past Appointments</h1>
<table>
  <tr>
        <th>Date</th>
        <th>Patient Name</th>
        <th>Morning Medicine</th>
        <th>Afternoon Medicine</th>
        <th>Night Medicine</th>
        <th>Comment</th>
      </tr>
<?php
  /*$today = date("Y-m-d");
  $dr_id = $_SESSION['user_id'];
  $query = "SELECT a.date, a.comment, u.user_id, a.patient_id, a.morn_med, a.aft_med, a.night_med, CONCAT(u.fname, ' ', u.lname) AS patient_name
            FROM appointment a, user u WHERE dr_id ='$dr_id' AND u.user_id=a.patient_id AND a.date < '$today'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
          $date = $row['date'];
          $patient_id = $row['patient_id'];
          $comment;
          $morn_med;
          $aft_med;
          $night_med;
          $patient_name = $row['patient_name'];
          echo "<tr><td>$date</td>
                <td>$patient_name</td>";
          if (!empty($row['comment'])) {
            $comment = $row['comment'];
            echo "<td>$comment</td>";
          } else {
            echo "<td>N/A</td>";
          }
          if (!empty($row['morn_med'])) {
            $morn_med = $row['morn_med'];
            echo "<td>$morn_med</td>";
          } else {
            echo "<td>N/A</td>";
          }
          if (!empty($row['aft_med'])) {
            $aft_med = $row['aft_med'];
            echo "<td>$aft_med</td>";
          } else {
            echo "<td>N/A</td>";
          }
          if (!empty($row['night_med'])) {
            $night_med = $row['night_med'];
            echo "<td>$night_med</td>";
          } else {
            echo "<td>N/A</td>";
          }
          echo "</tr></table>";
    }
  } else {
    echo "No past appointments";
  }
  ?>
  <h3>Appointments til date:</h3>
    <form action='' name='til_date' method='post'>
      <input type='date' name='date'>
      <input type='submit' name='submit'>
    </form><br/>

  <?php if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    if ($date >= $today) {
      $sql = "SELECT a.patient_id, a.date, CONCAT(u.fname, ' ', u.lname) as patient_name FROM user u, appointment a WHERE a.dr_id = '$dr_id' AND u.user_id = a.patient_id AND date <= '$date' AND date >= '$today'";
      $answer = $conn->query($sql);
      if ($answer->num_rows > 0) {
        echo "<table><tr><th>Patient Name</th><th>Appointment Date</th></tr>";
        while($row = $answer->fetch_assoc()) {
          $patient_name = $row['patient_name'];
          $appt_date = $row['date'];
          echo "<tr><td><a href='patient.php?id=$patient_id&appt_date=$appt_date'>$patient_name</a></td><td>$appt_date</td></tr>";
      }
      echo "</table>";
    } else {
      echo "No appointments set before $date";
    }

    } else {
      echo "Please select a future date";
    }
  }?>*/
