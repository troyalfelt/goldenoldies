<?php
session_start();
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
<?php if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $role_name = $_POST['role_name'];
    $sql = "INSERT INTO user (fname, lname, email, phone, password, dob, role_name) VALUES ('$fname', '$lname', '$email', '$phone', '$password', '$dob', '$role_name')";
    if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
  if ($role_name == 'Patient') {
    $qry = "SELECT user_id FROM user WHERE email = '$email'";
    $rslt = mysqli_query($conn, $qry);
    if ($rslt->num_rows > 0) {
    while($row = $rslt->fetch_assoc()) {
      $_SESSION['temp_id'] = $row['user_id'];
  }
  }
  header("Location: patient_register.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
<!--link rel="stylesheet" type="text/css" href="styles.css"/ -->
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>


  <a href='login.php'>Already have an account? Login here</a>
  <a href='logout.php'>Logout</a>
<div class="container">
    <form class="f-register" action="" method="post">
        <div class="user">
            <h1>Create New User</h1>
            <label for="role_name"><b>Select Role</b></label>
            <?php
            $query = "SELECT role_name FROM roles";
            $roles = $conn->query($query);
            $arr = [];
            if ($roles->num_rows > 0) {
            // output data of each row
            while($row = $roles->fetch_assoc()) {
              array_push($arr, $row['role_name']);
            }
          }
            ?>
            <select id="role" name="role_name" required>
              <?php
                foreach($arr as $r) { ?>
                  <option><?php echo $r; ?> </option>
              <?php } ?>
            </select><br>
            <label for="fName"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="fname" required><br>
            <label for="lName"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required><br>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" required><br>
            <label for="phone"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Phone Number" name="phone" id="phone" required><br>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Password" name="password" id="password" required><br>
                <label for="dob"><b>Date of Birth</b></label>
                <input type="date" name="dob" id="dob"><br>
                <input type="submit" class="btn" name="submit" value="Register">
            </div>
        </div>
    </form>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
<script type="text/javascript">
        var e = document.getElementById('redirect'); e.action='patient_register.php'; e.submit();
</script>
</body>
</html>
