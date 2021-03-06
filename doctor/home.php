<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '3') {
    header("Location: ../login.php");
}
}
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  <title><?php echo $_SESSION['name']?></title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="home.php" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Home</a>
              <a href="../patients.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patients</a>
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
        <h1 class="text-gray-900 text-5xl">Doctor's Home</h1>
        <h3 class="text-gray-400 text-3xl">Past Appointments</h3>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th
                scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Comment
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
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
              $today = date("Y-m-d");
              $dr_id = $_SESSION['user_id'];
              $query = "SELECT a.date, a.comment, u.user_id, a.patient_id, a.morn_med, a.aft_med, a.night_med, CONCAT(u.fname, ' ', u.lname) AS patient_name
                        FROM appointment a, user u WHERE dr_id ='$dr_id' AND u.user_id=a.patient_id AND a.date < '$today' ORDER BY a.date ASC";
              $result = $conn->query($query);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                      $date = $row['date'];
                      $patient_id = $row['patient_id'];
                      $comment;
                      $morn_med;
                      $aft_med;
                      $night_med;
                      $patient_name = $row['patient_name'];
                      echo '<tr>
                              <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                <div class="ml-4">
                                  <div class="text-sm font-medium text-gray-900">' . $date .
                                  '</div>
                                </div>
                              </div>
                              </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">' . $patient_name .
                            '</div>
                          </div>
                        </div>
                      </td>';
                      if (!empty($row['comment'])) {
                        $comment = $row['comment'];
                        echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">' . $comment .
                              '</div>
                            </div>
                          </div>
                        </td>';
                      } else {
                        echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">N/A' .
                              '</div>
                            </div>
                          </div>
                        </td>';
                      }
                      if (!empty($row['morn_med'])) {
                        $morn_med = $row['morn_med'];
                        echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">' . $morn_med .
                              '</div>
                            </div>
                          </div>
                        </td>';
                      } else {
                         echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">N/A</div>
                            </div>
                          </div>
                        </td>';
                      }
                      if (!empty($row['aft_med'])) {
                        $aft_med = $row['aft_med'];
                        echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">' . $aft_med .
                              '</div>
                            </div>
                          </div>
                        </td>';
                      } else {
                         echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">N/A
                              </div>
                            </div>
                          </div>
                        </td>';
                      }
                      if (!empty($row['night_med'])) {
                        $night_med = $row['night_med'];
                        echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">' . $night_med.
                              '</div>
                            </div>
                          </div>
                        </td>';
                      } else {
                         echo '<td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">N/A
                              </div>
                            </div>
                          </div>
                        </td>';
                      }
                }
                echo "</tr></tbody></table>";
              } else {
                echo "<tr><td><h2 class='mt-6 text-center text-2xl font-bold text-gray-900'>No past appointments</h2>'</td></tr>";
                echo "</tr></tbody></table>";
              }
              ?>


        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="p-4 shadow-md rounded-md text-left">
                    <form action="" method="post">
                        <div>
                            <label class="block mt-4">
                            <span class="text-gray-700">Appointment's Until:</span>
                            <input type="date" id="date" name="date" class="form-select mt-1 block w-full">
                            <input type='submit' name='submit'>
                            </label>
                        </div>
                      </form>
            </div>
        </div>
      </div>
        <h2 class="text-gray-900 text-5xl">Appointments</h2><br>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          <?php if (isset($_POST['submit'])) {
            $date = $_POST['date'];
            if ($date >= $today) {
              $sql = "SELECT a.patient_id, a.date, CONCAT(u.fname, ' ', u.lname) as patient_name FROM user u, appointment a WHERE a.dr_id = '$dr_id' AND u.user_id = a.patient_id AND date <= '$date' AND date >= '$today'";
              $answer = $conn->query($sql);
              if ($answer->num_rows > 0) {

                while($row = $answer->fetch_assoc()) {
                  $patient_name = $row['patient_name'];
                  $appt_date = $row['date'];
                  $patient_id = $row['patient_id'];
                  $appt_date = $row['date'];
                  echo '<tr><td class="px-6 py-4 whitespace-nowrap">
                   <div class="items-center">
                     <div class="items-center">
                       <div class="text-sm font-medium text-gray-900 flex items-center">';?>
                       <a href="patient.php?id=<?php echo $patient_id; ?>&appt_date=<?php echo $appt_date; ?>"><?php echo $patient_name . '</a>';?>
                       </div>
                     </div>
                   </div>
                 </td>
                 <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900"><?php echo $appt_date;?>
                      </div>
                    </div>
                  </div>
                </td></tr>'
                <?php
              }
              echo "</tbody></table>";
            } else {
              echo "<h3>No appointments set before $date</h3>";
            }

            } else {
              echo "<h3>Please select a future date</h3>";
            }
          }?>




      </div>
    </div>
  </div>
</div>
</body>
</html>
