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
   if (isset($_POST['submit'])) {
     $user_id = $_POST['user_id'];
     $group_number = $_POST['group_number'];
     $admit_date = $_POST['admit_date'];
     $qry = "UPDATE patient SET group_number='$group_number', admit_date='$admit_date' WHERE user_id = '$user_id'";
     $rslt = $conn->query($qry);
   }?>
<HTML>
  <head>
    <title>Patient Info</title>
    <link rel="stylesheet" href="../styles.css">
  </head>
  <body>
  <h1>Patient Admission</h1>
<table>
  <tr>
      <th>Patient ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Group</th>
      <th>Date Admitted</th>

  </tr>
<?php

  $sql = "SELECT user.user_id, user.fname, user.lname FROM user, patient WHERE user.user_id = patient.user_id AND approved = 1 AND user.role_name='Patient' AND patient.group_number IS NULL";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?><tr>
          <?php echo "<td>" . $row['user_id'] . "</td>"?>
          <?php echo "<td>" . $row["fname"] . "</td>"?>
          <?php echo "<td>" . $row["lname"] . "</td>"?>
          <td>
            <form action='' method='post' name='info'>
              <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
              <select name='group_number'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
              </select>
          </td>
          <td>
            <input type="date" name="admit_date" id="admit_date">
          </td>
          <td>
            <input type='submit' name='submit' value='Submit'>
          </form>
        </td>

        </tr>
<?php }
} else {
  echo "<h2>All Patient Info Up To Date</h2>";
}
?>
</table>

</body>
</html>
