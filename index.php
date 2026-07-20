<?php
$servername = "sql110.infinityfree.com";
$username   = "if0_42446707";
$password   = "THcMEoIDDLn";
$dbname     = "if0_42446707_myfrist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Read every record back out of the table
$sql = "SELECT id, name, age, status FROM MyGuests ORDER BY id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Form Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }

    /* Step 2: the form sits on ONE line */
    form {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 30px;
    }

    input[type="text"] {
      padding: 6px 8px;
      border: 1px solid #999;
    }

    input[type="submit"] {
      padding: 6px 16px;
      cursor: pointer;
    }

    /* Step 4: the records table */
    table {
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #999;
      padding: 8px 18px;
      text-align: center;
    }

    th {
      background: #eee;
    }
  </style>
</head>
<body>

  <!-- Steps 1 + 2: one-line form -->
  <form action="InsertData.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="ادخل اسمك">

    <label for="age">Age:</label>
    <input type="text" id="age" name="age" placeholder="ادخل عمرك">

    <input type="submit" value="Submit">
  </form>

  <!-- Step 4: all records from the table, below the form -->
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Status</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]     . "</td>";
        echo "<td>" . $row["name"]   . "</td>";
        echo "<td>" . $row["age"]    . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>0 results</td></tr>";
    }

    $conn->close();
    ?>
  </table>

</body>
</html>
