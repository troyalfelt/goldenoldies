<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>
<?php
  session_start();
  $servername = "localhost";
  $username = "troyalfelt";
  $password = "";
  $db = 'test';
  $conn = new mysqli($servername, $username, $password, $db);
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  $temp_id = $_SESSION['temp_id'];

  ?>
  <?php
  if (isset($_POST['submit'])) {
    $family_code = $_POST['fCode'];
    $emer_contact = $_POST['eContact'];
    $emer_phone = $_POST['ePhone'];
    $emer_relation = $_POST['relation'];
    $query = "UPDATE user SET family_code='$family_code', emer_contact='$emer_contact', emer_phone='$emer_phone', emer_relation='$emer_relation' WHERE user_id = '$temp_id'";
    $result = $conn->query($query);
    $_SESSION['temp_id'] = '';
  }
  ?>

  
<!--<form action='' method='post' class='f-register'>
  <?php //echo"<input type='hidden' name='user_id' value=" . $temp_id . ">";?>
  <label for="fCode"><b>Family Code</b></label>
  <input type="text" placeholder="Enter Code" name="fCode" id="fCode"><br>
  <label for="eContact"><b>Emergency Contact</b></label>
  <input type="text" placeholder="Enter Contact Name" name="eContact" id="eContact"><br>
  <label for="ePhone"><b>Emergency Contact Number</b></label>
  <input type="text" placeholder="Enter Contact Phone Number" name="ePhone" id="ePhone"><br>
  <label for="relation"><b>Relation to Emergency Contact</b></label>
  <input type="text" placeholder="Enter Relation" name="relation" id="relation"><br>
  <input type="submit" class="btn" name="submit" value="Register">
</form>-->
<!--Add any code above to the HTML below-->

<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Register</title>
</head>
<body class="h-full">
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <h1 class="text-yellow-400 text-5xl">Golden Oldies</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Patient Registration
        </h2>
      </div>

      <form class="mt-8 space-y-6" action="" method="POST">
          <?php echo"<input type='hidden' name='user_id' value=" . $temp_id . ">";?>
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="fCode" class="sr-only">Family Code</label>
            <input id="fCode" name="fCode" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter Family Code" required>
          </div>
          <div>
            <label for="eContact" class="sr-only">Emergency Contact</label>
            <input id="eContact" name="eContact" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter Emergency Contact" required><br>
          </div>
          <div>
            <label for="ePhone" class="sr-only">Emergency Contact Number</label>
            <input id="ePhone" name="ePhone" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Emergency Contact Number" required>
          </div>
          <div>
            <label for="relation" class="sr-only">Relation to Emergency Contact</label>
            <input id="relation" name="relation" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Relation to Emergency Contact" required><br>
          </div>
        </div>
        <p>Already have an account? <a href="login.php" class="text-yellow-400 hover:bg-gray-200">Login here.</a></p>
  
        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
