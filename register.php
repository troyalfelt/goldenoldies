

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
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  ?>


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
          Register for an account
        </h2>
        <?php if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $dob = $_POST['dob'];
            $role_name = $_POST['role_name'];
            $sql = "INSERT INTO user (fname, lname, email, phone, password, dob, role_name) VALUES ('$fname', '$lname', '$email', '$phone', '$password', '$dob', '$role_name')";
            if ($conn->query($sql) === TRUE) {
        echo '<h2 class="mt-6 text-center text-2xl font-extrabold text-gray-900">Account created, please wait for Admin approval</h2>';
        } else {
        echo 'Error: ' . $sql . "<br>" . $conn->error;
        }
          if ($role_name == 'Patient') {
            $qry = "SELECT user_id FROM user WHERE email = '$email'";
            $rslt = mysqli_query($conn, $qry);
            if ($rslt->num_rows > 0) {
            while($row = $rslt->fetch_assoc()) {
              $_SESSION['temp_id'] = $row['user_id'];
          }
          }
          header("Location: patient_register.php");
          }
        }
        ?>
      </div>
      <form class="mt-8 space-y-6" action="" method="POST">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
          <label for="role_name"><b>Select Role</b></label>
            <?php
            $query = "SELECT role_name FROM roles";
            $roles = $conn->query($query);
            $arr = [];
            if ($roles->num_rows > 0) {
            // output data of each row
            while($row = $roles->fetch_assoc()) {
              array_push($arr, $row['role_name']);
            }
          }
            ?>
            <select id="role" name="role_name" required>
              <?php
                foreach($arr as $r) { ?>
                  <option><?php echo $r; ?> </option>
              <?php } ?>
            </select><br>
          </div>
          <div>

            <label for="fname" class="sr-only">First Name</label>
            <input id="fname" name="fname" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter First Name" required>
          </div>
          <div>
            <label for="lname" class="sr-only">Last Name</label>



            <input id="lname" name="lname" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Enter Last Name" required><br>
          </div>
          <div>
            <label for="dob"><b>Date of Birth</b></label>

            <input id="dob" name="dob" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Date of Birth: mm/dd/yyyy" required>
          </div>
          <div>
            <div><label for="phone"><b>Phone Number</b></label><p class='text-grey-400 text-1xl'>Format: 123-456-7890</p></div>
            <input id="phone" name="phone" type="tel"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="123-456-7890" required><br>
          </div>
          <div>
            <label for="email" class="sr-only">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
          </div>
        <p>Already have an account? <a href="login.php" class="text-yellow-400 hover:bg-gray-200">Login here.</a></p>

        <div>


          <input value='Register' name='submit' type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">



        </div>
      </form>
    </div>
  </div>
<script type="text/javascript">
        var e = document.getElementById('redirect'); e.action='patient_register.php'; e.submit();
</script>
</body>
</html>
