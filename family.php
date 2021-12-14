<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: login.php");
} else {
  if ($_SESSION['access_lvl'] !== '6') {
    header("Location: login.php");
}
}

//125, 23
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
          <input id="dob" name="date" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Date of Birth: mm/dd/yyyy" required>
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
                Date
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
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Doctor's Appointment
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
                      //checks if form is submitted
                      if (isset($_POST['submit'])) {
                      $code = $_POST['code'];
                      $patient_id = $_POST['patient_id'];
                      $date = $_POST['date'];
                      $today = date('Y-m-d');
                      $patient_name;
                      if ($date <  $today) {
                      //checks if the codes are right
                      $qry = "SELECT CONCAT(fname, ' ', lname) AS patient_name FROM user WHERE family_code = '$code' AND user_id = '$patient_id'";
                      $patients = $conn->query($qry);
                      if ($patients->num_rows == TRUE) {
                        while($row = $patients->fetch_assoc()) {
                          $patient_name = $row['patient_name'];
                          echo $patient_name . "</div></div></div></td>";

                      }
                        $sql = "SELECT morn_status, aft_status, night_status, breakfast, lunch, dinner, dr_appt FROM routine WHERE patient_id='$patient_id' AND date='$date'";
                        $result = $conn->query($sql);
                        if ($result->num_rows >0) {
                          while ($row = $result->fetch_assoc()) {
                          $morn_status = $row['morn_status'];
                          $aft_status = $row['aft_status'];
                          $night_status = $row['night_status'];
                          $breakfast = $row['breakfast'];
                          $lunch = $row['lunch'];
                          $dinner = $row['dinner'];
                          $dr_appt = $row['dr_appt'];
                          echo "<td>" . $date . "</td>";
                          if ($morn_status == 0) {
                            echo "<td>Incomplete</td>";
                          } elseif ($morn_status == 1) {
                            echo "<td>Completed</td>";
                          } else {
                            echo "<td>None assigned</td>";
                          }
                          if ($aft_status == 0) {
                                echo "<td>Incomplete</td>";
                          } elseif ($aft_status == 1) {
                            echo "<td>Completed</td><";
                          } else {
                            echo "<td>None assigned</td>";
                          }
                          if ($night_status == 0) {
                              echo "<td>Incomplete</td>";
                          } elseif ($night_status == 1) {
                            echo "<td>Completed</td>";
                          } else {
                            echo "<td>None assigned</td>";
                          }
                          if ($breakfast == 0) {
                              echo "<td>Incomplete</td>";
                          } elseif ($breakfast == 1) {
                            echo "<td>Completed</td>";
                          }
                          if ($lunch == 0) {
                              echo "<td>Incomplete</td>";
                          } elseif ($lunch == 1) {
                            echo "<td>Completed</td>";
                          }
                          if ($dinner == 0) {
                              echo "<td>Incomplete</td>";
                          } elseif ($dinner == 1) {
                            echo "<td>Completed</td>";
                          }
                          $check_dr = "SELECT CONCAT(u.fname, ' ', u.lname) AS dr_name FROM appointment a, user u WHERE a.date = '$date'
                                      AND u.user_id = a.dr_id AND a.patient_id = '$patient_id'";
                          $get_name = $conn->query($check_dr);
                          $dr_name;
                          if ($get_name->num_rows > 0) {
                            while ($row = $get_name->fetch_assoc()) {
                              $dr_name = $row['dr_name'];
                            }
                          } else {
                            $dr_name = "administrator about schedule";
                          }
                          if ($dr_appt == 0) {
                              echo "<td>Incomplete, see " . $dr_name . "</td>";
                          } elseif ($dr_appt == 1) {
                            echo "<td>Completed</td>";
                          } else {
                            echo "<td>None assigned</td>";
                          }
                        }
                      } else {
                        echo '<h3 class="text-gray-900 text-3xl">No schedule set for that date, please contact administrator</h3></tr></tbody></table>';
                      }
                        echo "</tr></tbody></table>";
                      } else {
                        echo '<h3 class="text-gray-900 text-3xl">Incorrect family code/patient id</h3></tr></tbody></table>';
                      }


                  } else {
                    echo '<h3 class="text-gray-900 text-3xl">Please select a past date</h3>';
                  }
                }

                      ?>




          </tbody>
        </table-->
      </div>
    </div>
  </div>
</div>
</body>
</html>
