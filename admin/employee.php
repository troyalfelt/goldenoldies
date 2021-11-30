<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>

<?php
  if (isset($_POST['submit'])) {
    $pay_change = $_POST['pay_change'];
    $user_id = $_POST['user_id'];
    $qry = "UPDATE employee SET salary='$pay_change' WHERE user_id='$user_id'";
    $rslt = $conn->query($qry);
    if ($rslt == TRUE) {
      echo "Salary succesfully adjusted";
    }
  }?>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
  <div>
    <h2>Salary Management</h2>
  </div>
<div class="container">

  <h1>Employees</h1>
    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Salary</th>
      </tr>
      <?php $sql = "SELECT user.user_id, user.fname, user.lname, user.role_name, employee.salary FROM user, employee WHERE user.user_id = employee.user_id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          ?><tr>
                <?php echo "<td>" . $row["fname"] . "</td>"?>
                <?php echo "<td>" . $row["lname"] . "</td>"?>
                <?php echo "<td>" . $row["role_name"] . "</td>"?>
                <?php echo "<td>" . $row['salary'] . "</td>"?>
                <td>
                  <form action='' name='salary' method='post'>
                    <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                    <input type='text' name='pay_change' placeholder="<?php echo $row['salary'];?>">
                    <input type='submit' name='submit' value='Adjust Pay'/>
                  </form>
              </tr>
            <?php }
          }?>

    </table>

</div>

</body>
<script>  if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
