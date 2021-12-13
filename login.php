<?php
session_start();
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
  <title>Login</title>

</head>
<?php
$servername = "localhost";
$username = "troyalfelt";
$password = "";
$db = 'test';
$conn = new mysqli($servername, $username, $password, $db);
?>


<?php if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT user.user_id, email, fname, lname, password, family_code, user.role_name, roles.access_lvl FROM user, roles WHERE user.role_name = roles.role_name AND email='$email' AND password='$password' AND approved=1";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
      $_SESSION['role_name'] = $row['role_name'];
      $_SESSION['access_lvl'] = $row['access_lvl'];
      $_SESSION['fcode'] = $row['familly_code'];
    }
    if ($_SESSION['access_lvl'] <= 2) {
      header("Location: admin/new-roster.php");
    } elseif ($_SESSION['access_lvl'] == 3) {
      header("Location: doctor/home.php");
    } elseif ($_SESSION['access_lvl'] == 4) {
      header("Location: caregiver/home.php");
    } elseif ($_SESSION['access_lvl'] == 5) {
      if ($_SESSION['family_code'] == TRUE) {
      header("Location: patient/home.php");
    } else {
      $_SESSION['temp_id'] = $_SESSION['user_id'];
      header("Location: patient_register.php");
    }
    } elseif ($_SESSION['access_lvl'] == 6) {
      header("Location: family.php");
    }

  } else {
    echo 'Incorrect username/password';
  }
}
?>

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
          Sign in to your account
        </h2>
      </div>
      <form class="mt-8 space-y-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email" class="sr-only">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
          </div>
        </div>
        <p>Don't have an account? <a href="register.php" class="text-yellow-400 hover:bg-gray-200">Register here.</a></p>

        <div>
          <button name='submit' type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
