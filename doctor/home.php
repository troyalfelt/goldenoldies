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
<HTML>
<head><link rel="stylesheet" href="../styles.css">
  <title><?php echo $_SESSION['name']?>'s Home</title>
<head>
  <body>
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
  $today = date("Y-m-d");
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
          echo "<tr><td>$patient_name</td><td>$appt_date</td></tr>";
      }
      echo "</table>";
    } else {
      echo "No appointments set before $date";
    }

    } else {
      echo "Please select a future date";
    }
  }?>

</body>
