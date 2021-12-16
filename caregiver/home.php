
<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '4') {
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
    <title><?php echo $_SESSION['name'];?>'s Home</title>
  </head>
  <body class="h-full">
  <nav class="bg-gray-800">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
                <a href="../roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roster</a>
                <a href="info.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patient Info</a>
              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
          </div>
        </div>
      </div>
  </nav>
  <h2 class="text-gray-900 text-3xl">Welcome, <?php echo $_SESSION['name'];?></h2>
  <?php

  $today = date('Y-m-d');
  if (isset($_POST['insert'])) {
    $patient_id = $_POST['patient_id'];
    $morn_med;
    //check if box was checked
    if (isset($_POST['morn_status'])) {
      //check if the medicine was assigned
      if($morn_status='unassigned') {
        $morn_med = 2;
      } else {
        $morn_med = 1;
      }
    } else {
      $morn_med = 0;
    }

    $aft_med;
    if (isset($_POST['aft_status'])) {
      if($aft_status='unassigned') {
        $aft_med = 2;
      } else {
        $aft_med = 1;
      }
    } else {
      $aft_med = 0;
    }
    $night_med;
    if (isset($_POST['night_status'])) {
      if($night_status='unassigned') {
        $night_med = 2;
      } else {
        $night_med = 1;
      }
    } else {
      $night_med = 0;
    }
    $breakfast;
    if (isset($_POST['breakfast'])) {
      $breakfast = 1;
    } else {
      $breakfast = 0;
    }
    $lunch;
    if (isset($_POST['lunch'])) {
      $lunch = 1;
    } else {
      $lunch = 0;
    }
    $dinner;
    if (isset($_POST['dinner'])) {
      $dinner = 1;
    } else {
      $dinner = 0;
    }
    $insert = "INSERT INTO routine (date, patient_id, morn_status, aft_status, night_status, breakfast, lunch, dinner)
               VALUES('$today', '$patient_id', '$morn_med', '$aft_med', '$night_med', '$breakfast', '$lunch', '$dinner')";
    $inserted = $conn->query($insert);
  } elseif (isset($_POST['adjust'])) {
    //for adjusting an existing record
    $patient_id = $_POST['patient_id'];
    $morn_med;
    //check if box was checked
    if (isset($_POST['morn_status'])) {
      if($_POST['morn_status']=='unassigned') {
        $morn_med = 2;
      } else {
        $morn_med = 1;
      }
    } else {
      $morn_med = 0;
    }

    $aft_med;
    if (isset($_POST['aft_status'])) {
      if($_POST['aft_status']=='unassigned') {
        $aft_med = 2;
      } else {
        $aft_med = 1;
      }
    } else {
      $aft_med = 0;
    }

    $night_med;
    if (isset($_POST['night_status'])) {
      if ($_POST['night_status']=='unassigned') {
        $night_med = 2;
      } else {
        $night_med = 1;
      }
    } else {
      $night_med = 0;
    }

    $breakfast;
    if (isset($_POST['breakfast'])) {
        $breakfast = 1;
    } else {
      $breakfast = 0;
    }

    $lunch;
    if (isset($_POST['lunch'])) {
      $lunch = 1;
    } else {
      $lunch = 0;
    }

    $dinner;
    if (isset($_POST['dinner'])) {
      $dinner = 1;
    } else {
      $dinner = 0;
    }

    $adjust = "UPDATE routine SET morn_status='$morn_med', aft_status='$aft_med', night_status='$night_med', breakfast='$breakfast',
              lunch='$lunch', dinner='$dinner' WHERE patient_id = '$patient_id' AND date = '$today'";
    $adjusted = $conn->query($adjust);
  }
  ?>
  <?php
    $caregiver_id = $_SESSION['user_id'];

    $group;
    function display_group($group_num) {
      $caregiver_id = $_SESSION['user_id'];
      $today = date('Y-m-d');
      $servername = "localhost";
      $username = "troyalfelt";
      $password = "";
      $db = 'test';
      //pull all patients in group
      $conn = new mysqli($servername, $username, $password, $db);
      $query = "SELECT p.user_id, CONCAT(u.fname, ' ', u.lname) as patient_name FROM patient p, user u
      WHERE group_number = '$group_num' AND p.user_id = u.user_id";
      $answer = $conn->query($query);
      if ($answer->num_rows > 0) {
        echo '<table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50"><tr><th>Patient Name</th><th>Morning Med</th><th>Afternoon Med</th><th>Night Med</th>
              <th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr></thead><tbody>';
        while($row = $answer->fetch_assoc()) {
          $patient_name = $row['patient_name'];
          $patient_id = $row['user_id'];
          echo "<tr><td>$patient_name</td>";
          $check = "SELECT MAX(date) as recent, patient_id, morn_med, aft_med, night_med FROM appointment WHERE patient_id = '$patient_id'";
          $med_check = $conn->query($check);
          if ($med_check->num_rows > 0) {
            //check if the meds are assigned;
            while($row = $med_check->fetch_assoc()) {
              $recent = $row['recent'];
              $morn_med = $row['morn_med'];
              $aft_med = $row['aft_med'];
              $night_med = $row['night_med'];
              $in_routine = "SELECT morn_status, aft_status, night_status, breakfast, lunch, dinner FROM routine WHERE date='$today' AND patient_id='$patient_id'";
              $in_r = $conn->query($in_routine);
              //checks if its already in the routine table
              if ($in_r->num_rows > 0) {
                echo "<form action='' name='make_routine' method='POST'>
                      <input type='hidden' name='patient_id' value='$patient_id'>";
                while($row = $in_r->fetch_assoc()) {
                $morn_status = $row['morn_status'];
                $aft_status = $row['aft_status'];
                $night_status = $row['night_status'];
                $breakfast = $row['breakfast'];
                $lunch = $row['lunch'];
                $dinner = $row['dinner'];
                //make a form to change 'routine' row

                  if ($morn_status == 0) {
                    echo "<td><input type='checkbox' name='morn_status'></td>";
                  } elseif ($morn_status == 1) {
                    echo "<td>Completed</td><input type='hidden' name='morn_status' value='completed'>";
                  } else {
                    echo "<td>None assigned</td><input type='hidden' name='morn_status' value='unassigned'>";
                  }
                  if ($aft_status == 0) {

                    echo "<td><input type='checkbox' name='aft_status'></td>";
                  } elseif ($aft_status == 1) {

                    echo "<td>Completed</td><input type='hidden' name='aft_status' value='completed'>";
                  } else {

                    echo "<td>None assigned</td><input type='hidden' name='aft_status' value='unassigned'>";
                  }

                  if ($night_status == 0) {
                    echo "<td><input type='checkbox' name='night_status'></td>";
                  } elseif ($night_status == 1) {
                    echo "<td>Completed</td><input type='hidden' name='night_status' value='completed'>";
                  } else {
                    echo "<td>None assigned</td><input type='hidden' name='night_status' value='unassigned'>";
                  }
                  if ($breakfast == 0) {
                    echo "<td><input type='checkbox' name='breakfast'></td>";
                  } elseif ($breakfast == 1) {
                    echo "<td>Completed</td><input type='hidden' name='breakfast' value='completed'>";
                  }
                  if ($lunch == 0) {
                    echo "<td><input type='checkbox' name='lunch'></td>";
                  } elseif ($lunch == 1) {
                    echo "<td>Completed</td><input type='hidden' name='lunch' value='completed'>";
                  }
                  if ($dinner == 0) {
                    echo "<td><input type='checkbox' name='dinner'></td>";
                  } elseif ($dinner == 1) {
                    echo "<td>Completed</td><input type='hidden' name='dinner' value='completed'>";
                  }
                }
                echo "<td><input type='submit' name='adjust' value='Submit'></td></tr></form>";
              } else {
                //make a form to create a new 'routine' row
                echo "<form action='' name='make_routine' method='POST'>
                      <input type='hidden' name='patient_id' value='$patient_id'>";
                      //check if meds are assigned
                      if ($morn_med != NULL) {
                      echo "<td>$morn_med<input type='checkbox' name='morn_status'></td>";
                    } else {
                      echo "<input type='hidden' name='morn_status' value='unassigned'><td>None assigned</td>";
                    }
                    if ($aft_med != NULL) {
                    echo "<td>$aft_med<input type='checkbox' name='aft_status'></td>";
                  } else {
                    echo "<input type='hidden' name='aft_status' value='unassigned'><td>None assigned</td>";
                  }
                  if ($night_med != NULL) {
                  echo "<td>$night_med<input type='checkbox' name='night_status'></td>";
                } else {
                  echo "<input type='hidden' name='night_status' value='unassigned'><td>None assigned</td>";
                }
                echo "<td><input type='checkbox' name='breakfast'></td>
                      <td><input type='checkbox' name='lunch'></td>
                      <td><input type='checkbox' name='dinner'></td>
                      <td><input type='submit' name='insert' value='Submit'></td></tr></form>";

              }

            }
            }
      }
    }
    echo "</tbody></table>";
    }

    $sql = "SELECT caregiver1_id, caregiver2_id, caregiver3_id, caregiver4_id FROM roster WHERE date = '$today'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $cg1 = $row['caregiver1_id'];
        $cg2 = $row['caregiver2_id'];
        $cg3 = $row['caregiver3_id'];
        $cg4 = $row['caregiver4_id'];
        if ($cg1 == $caregiver_id) {
          display_group(1);
        } elseif ($cg2 == $caregiver_id) {
          display_group(2);
        } elseif ($cg3 == $caregiver_id) {
           display_group(3);
        } elseif ($cg4 == $caregiver_id) {
          display_group(4);
        } else {
          echo '<h3 class="text-gray-900 text-3xl">No patients scheduled for today</h3>';
        }
      }
    } else {
      echo '<h3 class="text-gray-900 text-3xl">No roster set for today. Please contact your supervisor.</h3>';
    }
    ?>
</body>
