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
  <div class="register">
    <form class="f-register" action="" method="post">
      <div class="user">
        <h1>Create New User</h1>
        <label for="role"><b>Select Role</b></label>
        <select id="role" name="role">
          <option value="admin">Admin</option>
          <option value="supervisor">Supervisor</option>
          <option value="doctor">Doctor</option>
          <option value="careGiver">Care Giver</option>
          <option value="patient">Patient</option>
          <option value="family">Family member</option>
        </select><br>
        <label for="fName"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="fName" id="fName" required><br>
        <label for="lName"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lName" id="lName" required><br>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" required><br>
        <label for="phone"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone" required><br>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password" id="password" required><br>
      </div>
      <div class="patient">
          <h2>For Patient</h2>
          <label for="dob"><b>Date of Birth</b></label>
          <input type="date" name="dob" id="dob"><br>
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