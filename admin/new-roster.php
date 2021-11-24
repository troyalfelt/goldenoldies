<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Roster</title>
  <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
<div class="container">
<h1>New Roster</h1>
  <form class="newR" action="" method="post">
    <div>
      <label for="date">Date</label>
      <input type="date" name="date" id="date">
    </div>
    <div class="supervisor">
      <label for="supervisor">Supervisor</label>
      <select class="roleSelect" name="supervisor">
        <option value="none">none</option>
      </select>
    </div>
    <div class="doctor">
      <label for="doctor">Doctor</label>
      <select class="roleSelect" name="doctor">
        <option value="none">none</option>
      </select>
    </div>
    <div class="care1">
      <label for="care1">Caregiver 1</label>
      <select class="roleSelect" name="care1">
        <option value="none">none</option>
      </select>
    </div>
    <div class="care2">
      <label for="care2">Caregiver 2</label>
      <select class="roleSelect" name="care2">
        <option value="none">none</option>
      </select>
    </div>
    <div class="care3">
      <label for="care3">Caregiver 3</label>
      <select class="roleSelect" name="care3">
        <option value="none">none</option>
      </select>
    </div>
    <div class="care4">
      <label for="care4">Caregiver 4</label>
      <select class="roleSelect" name="care4">
        <option value="none">none</option>
      </select>
    </div>
    <input type="submit" class="btn" name="submit" value="Okay">
  </form>
</div>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>