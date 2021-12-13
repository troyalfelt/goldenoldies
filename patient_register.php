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
  <!DOCTYPE html>
  <html class="h-full bg-gray-50" lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Approval</title>
  </head>
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
        </div>
      </div>
  </nav>
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Additional Patient Information
        </h2>
<form action='' method='post' class="mt-8 space-y-6">
  <?php echo"<input type='hidden' name='user_id' value=" . $temp_id . ">";?>
  <label for="fCode"><b>Family Code</b></label>
  <input type="text" placeholder="Enter Code" name="fCode" id="fCode" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required><br>
  <label for="eContact"><b>Emergency Contact</b></label>
  <input type="text" placeholder="Enter Contact Name" name="eContact" id="eContact"class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required><br>
  <label for="ePhone"><b>Emergency Contact Number</b><p class='text-grey-400 text-1xl'>Format: 123-456-7890</p></label>
  <input id="phone" name="ePhone" type="tel"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="123-456-7890" required><br>
  <label for="relation"><b>Relation to Emergency Contact</b></label>
  <input type="text" placeholder="Enter Relation" name="relation" id="relation" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required><br>
  <input value='Register' name='submit' type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

</form>
<?php
if (isset($_POST['submit'])) {
  $family_code = $_POST['fCode'];
  $emer_contact = $_POST['eContact'];
  $emer_phone = $_POST['ePhone'];
  $emer_relation = $_POST['relation'];
  $query = "UPDATE user SET family_code='$family_code', emer_contact='$emer_contact', emer_phone='$emer_phone', emer_relation='$emer_relation' WHERE user_id = '$temp_id'";
  $result = $conn->query($query);
  $_SESSION['temp_id'] = '';
  echo '<h2 class="mt-6 text-center text-2xl font-extrabold text-gray-900">Account created, please wait for Admin approval</h2>';
}
?>
</div>
</div>
</div>
</body>
</html>
