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
  if ($_SESSION['access_lvl'] > '4') {
    header("Location: ../login.php");
}
}
?>

<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Patients</title>
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
                    <a href="patients.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Patients</a>

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
        <h1 class="text-gray-900 text-5xl">Patients</h1>
        <form action="" method="post">
            <input type="text" name="value" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
          </form>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class=" px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's ID
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's First Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Last Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Patient's Age
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Emergency Contact
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Emergency Contact Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Admission Date
              </th>
            </tr>
          </thead>
         <tbody class="bg-white divide-y divide-gray-200">

            <!--More people... -->
            <?php if(isset($_POST['search']))
            {
                $value = $_POST['value'];
                // search in all table columns
                // using concat mysql function
                $query = "SELECT * FROM user JOIN patient WHERE user.user_id = patient.patient_id AND CONCAT(patient_id, fname, lname, admit_date, emer_phone, contact, age) LIKE '%$value%'";
                $search_result = $conn->query($query);


                }
                 else {
                  $query = "SELECT patient.patient_id, user.fname, user.lname, patient.age, patient.contact, patient.emer_phone, patient.admit_date FROM user, patient WHERE user.user_id = patient.patient_id";
                    $search_result = $conn->query($query);

                }
                ?>

                <?php
                   if ($search_result !== false && $search_result->num_rows > 0) {
                         while($row = $search_result->fetch_assoc()) {
                           ?><tr>
                     <?php echo "<td>" . $row["patient_id"]. "</td>"?>
                     <?php echo "<td>" . $row["fname"]. "</td>"?>
                     <?php echo "<td>" . $row["lname"]. "</td>"?>
                     <?php echo "<td>" . $row["age"]. "</td>"?>
                     <?php echo "<td>" . $row["emer_phone"]. "</td>"?>
                     <?php echo "<td>" . $row["contact"]. "</td>"?>
                     <?php echo "<td>" . $row["admit_date"]. "</td>"?>
                   <?php }
                 }
                 ?>
               </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
