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
  <title>Payment</title>
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
          Payment
        </h2>
        <form action='' method='POST'>
          <label for='patient_id'>Patient ID</label>
          <input type='text' name='patient_id'>
          <input type='submit' name='submit'>
        </form>
        <?php if (isset($_POST['submit'])) {
          $patient_id = $_POST['patient_id'];

          //check if there's a patient with that id
          $sql = "SELECT CONCAT(fname, ' ', lname) AS patient_name FROM user WHERE user_id='$patient_id' AND role_name = 'Patient' AND approved=1";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $total_owed = 0;
            $patient_name;
            while($row = $result->fetch_assoc()) {
              $patient_name = $row['patient_name'];
            }
            //get the admit date

            $sql = "SELECT total_paid, TIMESTAMPDIFF(day, admit_date, CURDATE()) AS time_stayed FROM patient WHERE user_id='$patient_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                //calculate amount from days spent
                $total_owed += (10 * $row['time_stayed']) - $row['total_paid'];
                //subtract payments already made
              }
            } else {
              //if there is no admit date set
              echo 'no admit date set';
            }
              //get the amount from doctor's Appointments
            $sql = "SELECT COUNT(dr_appt) AS appt_count FROM routine WHERE dr_appt = 1 AND patient_id='$patient_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                //calculate amount from days spent
                $total_owed += 50 * $row['appt_count'];
              }
          }
          //get amount from medicines
          $sql = "SELECT COUNT(morn_status) AS morn_count, COUNT(aft_status) AS aft_count, COUNT(night_status) AS night_count WHERE
                  user_id='$patient_id' AND (morn_status = 1 OR aft_status = 1 OR night_status = 1)";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      //calculate amount from days spent
                      $total_owed += ($row['morn_count'] * .16) + ($row['aft_count'] * .16) + ($row['night_count'] * .16);
                    }
                }
            //echo the amount owed
            echo "Total owed: $" . $total_owed;
            echo '<form action="" method="POST">
                  <label for="total_paid">Amount Paid</label>
                  <input type="text" name="total_paid">
                  <input type="hidden" name="patient_id" value=' . $patient_id . '><input type="submit" name="pay" value="make payment">

                  </form>';
          } else {
            //if theres no patient result
            echo 'No such patient';
          }
        } elseif ($_POST['pay']) {
          //if second form is submitted to make payment
          $patient_id = $_POST['patient_id'];
          $total_paid = $_POST['total_paid'];
          $sql = "UPDATE patient SET total_paid = total_paid + '$total_paid' WHERE user_id = '$patient_id'";
          $result = $conn->query($sql);
          if ($result == TRUE) {
            echo "Payment made succesfully";
        } else {
          echo 'Error';
        }
      }
        ?>
        </div>
    </div>
</div>
</body>
</html>
