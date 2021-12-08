<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '5') {
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
  <title>Patient Home</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">

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
        <h1 class="text-gray-900 text-5xl">Welcome, <?php echo $_SESSION['name'];?></h1>
        <h3 class="text-gray-900 text-3xl">Your Patient ID is <?php echo $_SESSION['user_id'];?></h3>
        <form action="" name='value' method="post" class="mt-8 space-y-6">
      <div style="width: 20%">
        <label for="dob" class="sr-only">Date of Birth</label>
        <input name="date" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Date of Birth: mm/dd/yyyy" required>
      </div>
      <input type='submit' name='submit' value='Check'>
    </form>

        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Morning Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Afternoon Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Night Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Breakfast
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Lunch
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Dinner
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
          <?php if (isset($_POST['submit'])) {
            $patient_id = $_SESSION['user_id'];
            $date = $_POST['date'];
            $sql = "SELECT morn_status, aft_status, night_status, breakfast, lunch, dinner FROM routine WHERE date = '$date' AND patient_id='$patient_id'";
            $result = $conn->query($sql);
            //checks if a routing is set for that day
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $morn_status = $row['morn_status'];
                  $aft_status = $row['aft_status'];
                  $night_status = $row['night_status'];
                  $breakfast = $row['breakfast'];
                  $lunch = $row['lunch'];
                  $dinner = $row['dinner'];
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
                    echo "<td>Completed</td><input type='hidden' name='night_status' value='completed'>";
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
                    echo "<td>Completed<td>";
                  }
                  if ($dinner == 0) {
                      echo "<td>Incomplete</td>";
                  } elseif ($dinner == 1) {
                    echo "<td>Completed</td>";
                  }
                }
                echo "</tr></tbody></table>";
              } else {
                echo 'No schedule set for that date, please contact administrator';
              }
            } else {
              //this is where today's table goes
              $patient_id = $_SESSION['user_id'];
              $date = date('Y-m-d');
              $sql = "SELECT morn_status, aft_status, night_status, breakfast, lunch, dinner FROM routine WHERE date = '$date' AND patient_id='$patient_id'";
              $result = $conn->query($sql);
              //checks if a routing is set for that day
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $morn_status = $row['morn_status'];
                    $aft_status = $row['aft_status'];
                    $night_status = $row['night_status'];
                    $breakfast = $row['breakfast'];
                    $lunch = $row['lunch'];
                    $dinner = $row['dinner'];
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
                      echo "<td>Completed</td><input type='hidden' name='night_status' value='completed'>";
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
                      echo "<td>Completed<td>";
                    }
                    if ($dinner == 0) {
                        echo "<td>Incomplete</td>";
                    } elseif ($dinner == 1) {
                      echo "<td>Completed</td>";
                    }
                  }
                  echo "</tr></tbody></table>";
                } else {
                  echo 'No schedule set yet for today, please contact administrator';
                }
            }
?>
