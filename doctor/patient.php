<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '3') {
    header("Location: ../login.php");
}
}
if (!isset($_GET['id'])) {
  header("Location: home.php");
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
<HTML>
<head>
  <title>Patient Schedule</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>


<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Patient Name</title>
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
        <h1 class="text-gray-900 text-5xl">Specific patient</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th
                scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Comment
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
          </tbody>
        </table>
        </div>
    </div>
  </div>
</div>

<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          New Prescription
        </h2>
        <form class="mt-8 space-y-6" action="" method="POST">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="comment" class="sr-only">Comment</label>
                    <textarea id="comment" name="comment" placeholder="Comment" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required></textarea>
                </div>
                <div>
                    <label for="morning_med" class="sr-only">Morning Med</label>
                    <input id="morning_med" name="morning_med" type="text" placeholder="Morning Med" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required><br>
                </div>
                <div>
                    <label for="afternoon_med" class="sr-only">Afternoon Med</label>
                    <input id="afternoon_med" name="afternoon_med" type="text" placeholder="Afternoon Med" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                </div>
                <div>
                    <label for="night_med" class="sr-only">Night Med</label>
                    <input id="night_med" name="night_med" type="text" placeholder="Night Med" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required><br>
                </div>
            </div>
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
?php
  $today = date('Y-m-d');
  $patient_id = $_GET['id'];
  $appt_date = $_GET['appt_date'];
  $patient_name;
  $query = "SELECT CONCAT(fname, ' ', lname) as patient_name FROM user WHERE user_id = '$patient_id'";
  $get_name = $conn->query($query);
  if ($get_name->num_rows>0) {
    while($row = $get_name->fetch_assoc()) {
      $patient_name = $row['patient_name'];
    }
  }
  //displays most recent past appointment
  echo "<h2>Most recent appointment for $patient_name</h2>";
  $sql = "SELECT a.date, a.comment, a.morn_med, a.aft_med, a.night_med, a.dr_id, CONCAT(u.fname, ' ', u.lname) as dr_name
  FROM appointment a, user u WHERE a.patient_id='$patient_id' AND a.date < '$today' AND a.dr_id = u.user_id ORDER BY a.date DESC LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      echo "<table><tr><th>Date</th><th>Comment</th><th>Morning Medicine</th><th>Afternoon Medicine</th><th>Night Medicine</th><th>Doctor</th></tr>";
      while($row = $result->fetch_assoc()) {
        $date = $row['date'];
        $dr_name = $row['dr_name'];
        $comment;
        $morn_med;
        $aft_med;
        $night_med;
        echo "<tr><td>$date</td>";
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
        echo "<td>$dr_name</td></tr></table><br/>";
  }
} else {
  echo "No past appointments";
}
//displays next appt_date
echo "<h2>Next appointment for $patient_name</h2><br/>
      <table><tr><th>Date</th><th>Comment</th><th>Morning Medicine</th><th>Afternoon Medicine</th><th>Night Medicine</th><th>Doctor</th></tr>";

$sql = "SELECT a.date, CONCAT(u.fname, ' ', u.lname) as dr_name FROM appointment a, user u WHERE a.patient_id='$patient_id'
AND a.date >= '$today' AND a.dr_id = u.user_id AND a.comment IS NULL ORDER BY a.date ASC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $next_date = $row['date'];
    $next_dr = $row['dr_name'];
    echo "<tr><td>$next_date</td>";
    //checks if its today
    if ($next_date == $today) {
      echo "<form name='complete' action='' method='POST'>
              <td><input type='text' name='comment' placeholder='Write a comment' required></td>
              <td><input type='text' name='morn_med' placeholder='Morning Medicine' required></td>
              <td><input type='text' name='aft_med' placeholder='Afternoon Medicine' required></td>
              <td><input type='text' name='night_med' placeholder='Night Medicine' required></td>
              <td>$next_dr</td>
              <td><input type='submit' name='submit' value='Submit'></td></tr>";
    } else {
      echo "<td>N/A</td>
              <td>N/A</td>
              <td>N/A</td>
              <td>N/A</td>
              <td>$next_dr</td>
              <td>Cannot be submitted before $next_date</td></tr>";
    }
  }
} else {
  echo "<tr><td>No appointments scheduled</td></tr>";
}
echo "</table>";
if (isset($_POST['submit'])) {
  $comment = $_POST['comment'];
  $morn_med = $_POST['morn_med'];
  $aft_med = $_POST['aft_med'];
  $night_med = $_POST['night_med'];
  $sql2 = "UPDATE appointment SET comment = '$comment', morn_med = '$morn_med', aft_med = '$aft_med', night_med='$night_med' WHERE patient_id='$patient_id' AND date = '$today'";
  $result2 = $conn->query($sql2);
  if ($result2 == TRUE) {
    echo 'Appointment succesfully completed';
  } else {
    echo "error " . $conn->error;
  }
}
  ?>
</body>
</HTML>
