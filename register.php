<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
  <?php
  $servername = "localhost";
  $username = "troyalfelt";
  $password = "";
  $db = 'test';
  $conn = new mysqli($servername, $username, $password, $db);
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
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

$conn->close();
  }

  ?>
  <div class="container">
    <form class="f-register" action="" method="post">
      <div class="user">
        <h1>Create New User</h1>
        <label for="role"><b>Select Role</b></label>
        <input type="text" placeholder="Enter Role Name" name="role_name" id="role_name">
        <br>
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
            <div class="patient">
              <h2>For Patients</h2>
          <label for="fCode"><b>Family Code</b></label>
          <input type="text" placeholder="Enter Code" name="fCode" id="fCode"><br>
          <label for="eContact"><b>Emergency Contact</b></label>
          <input type="text" placeholder="Enter Contact" name="eContact" id="eContact"><br>
          <label for="relation"><b>Relation to Emergency Contact</b></label>
          <input type="text" placeholder="Enter Relation" name="relation" id="relation"><br>
          <input type="submit" class="btn" name="submit" value="Register">
      </div>
    </form>
  </div>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>
