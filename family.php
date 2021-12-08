<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: login.php");
} else {
  if ($_SESSION['access_lvl'] !== '6') {
    header("Location: login.php");
}
}
?>

<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Family Home</title>
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
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">

            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <a href="logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
        </div>
      </div>
    </div>
</nav>

<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <h1 class="text-gray-900 text-5xl">Family Home</h1>
          <form action="" name='value' method="post" class="mt-8 space-y-6">
        <div style="width: 20%">
          <label for="dob" class="sr-only">Date of Birth</label>

          <input id="dob" name="dob" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Date of Birth: mm/dd/yyyy" required>
        </div>

       <div style="width: 20%">
          <label for="code" class="sr-only">Family Code</label>

          <input id="code" name="code" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter Family code" required>
        </div>

        <div style="width: 20%">
          <label for="patient_id" class="sr-only">Patient_id</label>

          <input id="patient_id" name="patient_id" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter Patient ID" required>
        </div>

        <input type='submit' name='submit' value='Check'>
      </form>

      <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Doctor's Name
              </th>
              <th
                scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Doctor's Appointment
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Caregiver's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Morning Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Afternoon Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Night Medicine
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Breakfast
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Lunch
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Dinner
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      <?php
                      if (isset($_POST['submit'])) {
                      $code = $_POST['code'];
                      $patient = $_POST['patient_id'];
                      $qry = "SELECT patient.code, user.user_id, CONCAT(user.fname, ' ', user.lname) AS full_name FROM user, patient WHERE user.role_name ='Patient' AND user.user_id = '$patient'";
                      $patients = $conn->query($qry);
                      $arr = [];
                      if ($patients->num_rows == TRUE) {
                      // output data of each row
                      while($row = $patients->fetch_assoc()) {
                        $patient_id = $row['user_id'];
                        $full_name = $row['full_name'];
                        $arr[$patient_id] = $full_name;
                        echo $row['full_name'];
                      }
                    }
                  }
                      ?>
                    </div>
                  </div>
                </div>

             </td>
              <td name = 'dr_id' class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      <?php
                      if (isset($_POST['submit'])) {
                        $date = $_POST['date'];
                        $sql = "SELECT roster.dr_id, user.user_id, user.fname, user.lname FROM roster, user WHERE roster.date='$date' AND roster.dr_id = user.user_id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                                $dr_id = $row['dr_id'];
                                echo $row['dr_id'];
                              }
                            }
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
            </tr>
          </tbody>
        </table-->
      </div>
    </div>
  </div>
</div>
</body>
</html>
