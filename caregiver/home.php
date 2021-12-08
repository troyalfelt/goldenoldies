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
  <header>
    <title>Caregiver Home</title>
    <link rel="stylesheet" href="../styles.css">
  </header>
  <body>
  <h2>Welcome</h2>
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
        echo '<table><tr><th>Patient Name</th><th>Morning Med</th><th>Afternoon Med</th><th>Night Med</th>
              <th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>';
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
                echo "<td>Breakfast<input type='checkbox' name='breakfast'></td>
                      <td>Lunch<input type='checkbox' name='lunch'></td>
                      <td>Dinner<input type='checkbox' name='dinner'></td>
                      <td><input type='submit' name='insert' value='Submit'></td></tr></form>";

              }

            }
            } else {
              echo 'not funky';
        }
      }
    }
    echo "</table>";
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
          echo "No patients scheduled for today";
        }
      }
    } else {
      echo "No roster set for today. Please contact your supervisor.";
    }
    ?>
</body>
