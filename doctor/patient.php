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


<?php
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
