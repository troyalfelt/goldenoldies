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
<form action='' method='post' class='f-register'>
  <?php echo"<input type='hidden' name='user_id' value=" . $temp_id . ">";?>
  <label for="fCode"><b>Family Code</b></label>
  <input type="text" placeholder="Enter Code" name="fCode" id="fCode"><br>
  <label for="eContact"><b>Emergency Contact</b></label>
  <input type="text" placeholder="Enter Contact Name" name="eContact" id="eContact"><br>
  <label for="ePhone"><b>Emergency Contact Number</b></label>
  <input type="text" placeholder="Enter Contact Phone Number" name="ePhone" id="ePhone"><br>
  <label for="relation"><b>Relation to Emergency Contact</b></label>
  <input type="text" placeholder="Enter Relation" name="relation" id="relation"><br>
  <input type="submit" class="btn" name="submit" value="Register">
</form>
