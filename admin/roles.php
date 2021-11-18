<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Roles</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      display: flex;
      flex-direction: column;
      align-content: space-between;
      align-items: center;
    }
    header {
      background-color: #7fffd4;
      width: 100%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        width: 500px;
    }
    footer {
      background-color: #C0C0C0;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }
  </style>
</head>
<body>
  <header>
      <h1>Golden Oldies</h1>
  </header>
  <div class="table">
      <table>
        <tr>
            <th>Role</th>
            <th>Access Level</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
  </div>
  <form action="" method="post" class="roles">
      <label for="role"><b>New Role</b></label><br>
      <input type="text" placeholder="Enter Role" name="role" id="role" required><br>
      <label for="accsess"><b>Access Level</b></label><br>
      <input type="text" placeholder="Enter Access Level" name="access" id="access" required><br>
      <div>
      <input type="submit" class="btn" name="submit" value="Okay">
      </div>
  </form>
<footer>
    <h3>Contact Us</h3>
    <p>000-000-0000</p>
</footer>
</body>
</html>