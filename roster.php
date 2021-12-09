<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Roster</title>
</head>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>

<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
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
        <h1 class="text-gray-900 text-5xl">Roster</h1>
            <div style="text-align: center"> Date:  <?php
            echo date("Y-n-d");
            ?>
        </div>
        <?php

            $sql = "SELECT date, supervisor_id, dr_id, caregiver1_id, caregiver2_id, caregiver3_id, caregiver4_id FROM roster WHERE date = date(now())";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
          while(($row = $result->fetch_assoc()) !== null){
              ?>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
            <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Supervisor
              </th>
              <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Doctor
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver 1
              </th>
              <th
                scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver 2
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver 3
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver 4
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
            <td name = 'supervisor_id' class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      <?php
                      $query = "SELECT roster.date, user.user_id, roster.supervisor_id, CONCAT(user.fname, ' ', user.lname) AS full FROM user, roster WHERE roster.supervisor_id = user.user_id AND roster.date = date(now())";
                      $result = $conn->query($query);
                        if ($result !== false && $result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                       echo $row["full"]
  ?>
                      <?php }
                    }
                      ?>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      <?php
                      $query = "SELECT roster.date, user.user_id, roster.dr_id, CONCAT(user.fname, ' ', user.lname) AS full1 FROM user, roster WHERE roster.dr_id = user.user_id AND roster.date = date(now())";
                      $result = $conn->query($query);
                        if ($result !== false && $result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                       echo $row["full1"]
  ?>
                      <?php }
                    }
                      ?>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?php
                  $query = "SELECT roster.date, user.user_id, roster.caregiver1_id, CONCAT(user.fname, ' ', user.lname) AS full2 FROM user, roster WHERE roster.caregiver1_id = user.user_id AND roster.date = date(now())";
                  $result = $conn->query($query);
                    if ($result !== false && $result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                   echo $row["full2"]
?>
                  <?php }
                }
                ?>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?php
                  $query = "SELECT roster.date, user.user_id, roster.caregiver2_id, CONCAT(user.fname, ' ', user.lname) AS full3 FROM user, roster WHERE roster.caregiver2_id = user.user_id AND roster.date = date(now())";
                  $result = $conn->query($query);
                    if ($result !== false && $result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                   echo $row["full3"]
?>
                  <?php }
                }
                ?>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?php
                  $query = "SELECT roster.date, user.user_id, roster.caregiver3_id, CONCAT(user.fname, ' ', user.lname) AS full4 FROM user, roster WHERE roster.caregiver3_id = user.user_id AND roster.date = date(now())";
                  $result = $conn->query($query);
                    if ($result !== false && $result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                   echo $row["full4"]
?>
                  <?php }
                }
                ?>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  <?php
                  $query = "SELECT roster.date, user.user_id, roster.caregiver4_id, CONCAT(user.fname, ' ', user.lname) AS full5 FROM user, roster WHERE roster.caregiver4_id = user.user_id AND roster.date = date(now())";
                  $result = $conn->query($query);
                    if ($result !== false && $result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                   echo $row["full5"]
?>
                  <?php }
                }
                ?>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    <?php }
  }
 ?>
</tr>

</body>
</html>
