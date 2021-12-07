<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Roster</title>
</head>
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
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <h1 class="text-gray-900 text-5xl">Roster</h1>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="p-4 shadow-md rounded-md text-left">
                    <form action="" method="post">
                        <div>
                            <label class="block mt-4">
                            <span class="text-gray-700">Date</span>
                            <input type="date" id="date" name="date" class="form-select mt-1 block w-full">
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
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
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      Example
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  Example
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  Admin
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  Example
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  Example
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!--Add any code below to the HTML above
<div> Date:  <?php
/*echo date("Y-n-d");
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
  } */?>

<?php

?>
</tr>
<tr>
<td></td>
<td></td>
<td>Patient group</td>
<td>Patient group</td>
<td>Patient group</td>
<td>Patient group</td>
</tr>
</table>-->
</body>
</html>