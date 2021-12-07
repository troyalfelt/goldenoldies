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
   <!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Patient Info</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="admin.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Home</a>
              <a href="appt.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Appointments</a>
              <a href="approval.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Approval</a>
              <a href="employee.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Employees</a>
              <a href="../patients.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patients</a>
              <a href="new-roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">New Roster</a>
              <a href="report.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Report</a>
              <a href="roles.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles</a>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
        </div>
      </div>
    </div>
</nav>

<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Additional Patient Information
        </h2>
        <?php

          $sql = "SELECT user.user_id, user.fname, user.lname FROM user, patient WHERE user.user_id = patient.user_id AND approved = 1 AND user.role_name='Patient' AND patient.group_number IS NULL";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo '<div class="rounded-md shadow-sm -space-y-px">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                      <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Admitted</th>';
          while($row = $result->fetch_assoc()) {
            ?><tr>
                  <?php echo "<td>" . $row['user_id'] . "</td>"?>
                  <?php echo "<td>" . $row["fname"] . "</td>"?>
                  <?php echo "<td>" . $row["lname"] . "</td>"?>
                  <td>
                    <form class="mt-8 space-y-6"action='' method='post' name='info'>
                      <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                      <select name='group_number'>
                        <option>Select a group</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                      </select>
                  </td>
                  <td>
                    <input type="date" name="admit_date" id="admit_date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                  </td>
                  <td>
                    <input type='submit' name='submit' value='Submit'  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                  </form>
                </td>
                </tr>
        <?php }
        echo "</table>";
        } else {
          echo "<h2>All Patient Info Up To Date</h2>";
        }
        ?>


        </div>
    </div>
</div>
</div>
</body>
</html>

<!--Add any of the code below into the HTML above-->
