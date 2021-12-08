<?php
session_start();
if (!isset($_SESSION['access_lvl'])) {
  header("Location: ../login.php");
} else {
  if ($_SESSION['access_lvl'] !== '3') {
    header("Location: ../login.php");
}
}
if (!isset($_GET['id'])) {
  header("Location: home.php");
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
<HTML>
<head>
  <title>Patient Schedule</title>
  <link rel="stylesheet" href="../styles.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
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
              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <a href="../logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
          </div>
        </div>
      </div>
  </nav>

<?php
  $today = date('Y-m-d');
  $patient_id = $_GET['id'];
  $appt_date = $_GET['appt_date'];
  $patient_name;
  $query = "SELECT CONCAT(fname, ' ', lname) as patient_name FROM user WHERE user_id = '$patient_id'";
  $get_name = $conn->query($query);
  if ($get_name->num_rows>0) {
    while($row = $get_name->fetch_assoc()) {
      $patient_name = $row['patient_name'];
    }
  }
  //displays most recent past appointment
  echo "<h2>Most recent appointment for $patient_name</h2>";
  $sql = "SELECT a.date, a.comment, a.morn_med, a.aft_med, a.night_med, a.dr_id, CONCAT(u.fname, ' ', u.lname) as dr_name
  FROM appointment a, user u WHERE a.patient_id='$patient_id' AND a.date < '$today' AND a.dr_id = u.user_id ORDER BY a.date DESC LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      echo '<table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Date
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Doctor
            </th></tr>';

            while($row = $result->fetch_assoc()) {
              $date = $row['date'];
              $dr_name = $row['dr_name'];
              $comment;
              $morn_med;
              $aft_med;
              $night_med;
              echo "<tr><td>$date</td>";
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
                      <div class="text-sm font-medium text-gray-900">
                        N/A
                      </div>
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
                      <div class="text-sm font-medium text-gray-900">
                        N/A
                      </div>
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
                      <div class="text-sm font-medium text-gray-900">
                        N/A
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
                      <div class="text-sm font-medium text-gray-900">' . $night_med .
                      '</div>
                    </div>
                  </div>
                </td>';
              } else {
                echo '<td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        N/A
                      </div>
                    </div>
                  </div>
                </td>';
              }
              echo '<td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">' . $dr_name .
                    '</div>
                  </div>
                </div>
              </td>';
          }
          echo "</tbody></table>";
          } else {
          echo "<h3>No past appointments</h3>";
          }
?>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Next Appointment
        </h2>

          <?php $sql = "SELECT a.date, CONCAT(u.fname, ' ', u.lname) as dr_name FROM appointment a, user u WHERE a.patient_id='$patient_id'
            AND a.date >= '$today' AND a.dr_id = u.user_id AND a.comment IS NULL ORDER BY a.date ASC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              ?>
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
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
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Doctor
                    </th>
                  </tr>
              <?php
              while($row = $result->fetch_assoc()) {
                $next_date = $row['date'];
                $next_dr = $row['dr_name'];
                echo '<tr><td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">' .
                        $next_date .
                      '</div>
                    </div>
                  </div>
                </td>';
                //checks if its today
                if ($next_date == $today) {
                  echo '<form class="mt-8 space-y-6" name="complete" action="" method="POST">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                <input type="text" name="comment" placeholder="Write a comment" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                <input type="text" name="morn_med" placeholder="Morning Medicine" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                <input type="text" name="aft_med" placeholder="Afternoon Medicine" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                <input type="text" name="night_med" placeholder="Night Medicine" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>' . $next_dr . '</td>
                          <td><input type="submit" name="submit" value="Submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></td></tr>';
                } else {
                echo '<td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          N/A
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          N/A
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          N/A
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          N/A
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">'  . $next_dr .
                        '</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          Cannot be submitted before ' . $next_date .
                        '</div>
                      </div>
                    </div>
                  </td>';

                }

              }
            } else {
              echo "<h3>No appointments scheduled<h3>";
            }
            echo "</table>";?>
<?php
if (isset($_POST['submit'])) {
  $comment = $_POST['comment'];
  $morn_med = $_POST['morn_med'];
  $aft_med = $_POST['aft_med'];
  $night_med = $_POST['night_med'];
  $sql2 = "UPDATE appointment SET comment = '$comment', morn_med = '$morn_med', aft_med = '$aft_med', night_med='$night_med' WHERE patient_id='$patient_id' AND date = '$today'";
  $result2 = $conn->query($sql2);
  if ($result2 == TRUE) {
    echo 'Appointment succesfully completed';
  } else {
    echo "error " . $conn->error;
  }
}
  ?>
</body>
</HTML>
