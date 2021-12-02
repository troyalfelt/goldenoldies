<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Roster</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Golden Oldies</h1>
</header>

<h2>Roster</h2>
<div> Date:  <?php
echo date("Y-n-d");
?> </div>
<br><br>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>

<?php

    $sql = "SELECT  date, supervisor_id, dr_id, caregiver1_id, caregiver2_id, caregiver3_id, caregiver4_id FROM roster WHERE date = date(now())";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
<table>
  <tr>
      <th>Supervisor</th>
      <th>Doctor</th>
      <th>Caregiver 1</th>
      <th>Caregiver 2</th>
      <th>Caregiver 3</th>
      <th>Caregiver 4</th>
  </tr>
<tr>
              <?php echo "<td>" . $row["supervisor_id"] . "</td>"?>
              <?php echo "<td>" . $row["dr_id"] . "</td>"?>
              <?php echo "<td>" . $row["caregiver1_id"] . "</td>"?>
              <?php echo "<td>" . $row["caregiver2_id"] . "</td>"?>
              <?php echo "<td>" . $row["caregiver3_id"] . "</td>"?>
              <?php echo "<td>" . $row["caregiver4_id"] . "</td>"?>
    <?php }
  } ?>

<?php

?>
</tr>
<tr>
<td></td>
<td></td>
<!--<td>Patient group</td>
<td>Patient group</td>
<td>Patient group</td>
<td>Patient group</td>-->
</tr>
</table>
<footer>
  <h3>Contact Us</h3>
  <p>000-000-0000</p>
</footer>
</body>
</html>
