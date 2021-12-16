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
      if ($_SESSION['access_lvl'] !== '1') {
        header("Location: ../login.php");
    }
  }?>
  <?php
  $servername = "localhost";
  $username = "troyalfelt";
  $password = "";
  $db = 'test';
  $conn = new mysqli($servername, $username, $password, $db);
  ?>
  <?php if (isset($_POST['submit'])) {
    $role = $_POST['role'];
    $access = $_POST['access'];
    $sql = "INSERT INTO roles (role_name, access_lvl) VALUES ('$role', '$access')";


    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  ?>
<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>New Roster</title>
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
              <a href="info.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patient Info</a>
              <a href="new-roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">New Roster</a>
              <a href="report.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Report</a>
                  <a href="payment.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Payment</a>
                  <a href="../roster.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roster</a>
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
        <h1 class="text-gray-900 text-5xl">Roles</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
            <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
              </th>
              <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Access Level
              </th>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php

                $sql = "SELECT role_name, access_lvl FROM roles ORDER BY access_lvl ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  ?><tr>
                        <?php echo '<td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">' . $row['role_name'] .
                                '</div>
                              </div>
                            </div>
                          </td>'; ?>
                          <?php echo '<td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                <div class="ml-4">
                                  <div class="text-sm font-medium text-gray-900">' . $row['access_lvl'] .

                                  '</div>
                                </div>
                              </div>
                            </td>'; ?>
                      </tr>
            <?php }
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          New Role
        </h2>
      </div>
      <form class="mt-8 space-y-6" action="" method="POST">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="role" class="sr-only">New Role</label>
            <input id="role" name="role" type="text" placeholder="Role Name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
          <div>
            <label for="access" class="sr-only">Access Level</label>
            <select id="access" name="access" class="form-select mt-1 block w-full">
              <option value=''>Select Access Level</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
            </select>
          </div>
        </div>
        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Submit
          </button>
        </div>
        <div>
          <button name='submit' type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
