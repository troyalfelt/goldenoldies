<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '1') {
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

<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Approval</title>
</head>


 <?php
 if (isset($_POST['submit']))  {
       $user_id = $_POST['user_id'];
       if ($_POST['status'] == 'approved') {
         $access_lvl = $_POST['access_lvl'];
         $qry = "UPDATE user SET approved = 1 WHERE user_id= '$user_id'";
         $rslt = $conn->query($qry);
         if ($access_lvl <= 4) {
           $qry2 = "INSERT INTO employee (user_id) VALUES ('$user_id')";
           $rslt2 = $conn->query($qry2);
           echo 'Employee Registered';
         } elseif ($access_lvl == 5) {
           $qry2 = "INSERT INTO patient (user_id) VALUES ('$user_id')";
           $rslt2 = $conn->query($qry2);
         } else {
           $qry2 = "INSERT INTO family (user_id) VALUES ('$user_id')";
           $rslt2 = $conn->query($qry2);
         }
         } else {
           $qry = "DELETE FROM user WHERE user_id= '$user_id'";
           $rslt = $conn->query($qry);
           if ($rslt == TRUE) {
             echo "User deleted";
           } else {
               echo "Error deleting record: " . $conn->error;
           }
         }
}
?>
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
              <a href="employee.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Employees</a>
              <a href="info.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patient Info</a>
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

<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <h1 class="text-gray-900 text-5xl">Registration Approval</h1>


            <!-- More people... -->
<?php

    $sql = "SELECT user.user_id, user.fname, user.lname, user.role_name, roles.access_lvl FROM user, roles WHERE approved = 0 AND user.role_name = roles.role_name";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      ?><table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              First Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Last Name
            </th>
            <th
              scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Role
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Approval
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
  <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
              <?php echo $row["fname"]; ?>
            </div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
              <?php echo $row["lname"]; ?>
            </div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
              <?php echo $row["role_name"]; ?>
            </div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
              <form action='' method='post' name='approved' class="mt-8 space-y-6">
                <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                <?php echo"<input type='hidden' name='access_lvl' value=" . $row['access_lvl'] . ">";?>
                <input type='hidden' name='status' value='approved'>
                <input type='submit' name='submit' value='Approve' class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                </form>
            </div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">
              <form action='' method='post' name='disapproved' class="mt-8 space-y-6">
                <?php echo"<input type='hidden' name='user_id' value=" . $row['user_id'] . ">";?>
                <input type='hidden' name='status' value='disapproved'>
              <input type='submit' name='submit' value='Disapprove' class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              </form>
            </div>
          </div>
        </div>
      </td>
          </tr>
<?php }
} else {
  ?> <div class="flex items-center"><h3>All users approved</h3></div>
<?php }
  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
