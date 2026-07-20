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

// Step 4: read every record back out of the table
$sql = "SELECT id, name, age, status FROM `user` ORDER BY id";
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

    /* Step 5: the toggle button */
    .toggle-btn {
      padding: 4px 14px;
      cursor: pointer;
    }

    .toggle-btn:disabled {
      opacity: 0.5;
      cursor: wait;
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
      <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        echo "<tr>";
        echo "<td>" . $id           . "</td>";
        echo "<td>" . $row["name"]  . "</td>";
        echo "<td>" . $row["age"]   . "</td>";
        // the id on this cell is how JavaScript finds it again after toggling
        echo "<td id='status-" . $id . "'>" . $row["status"] . "</td>";
        echo "<td><button class='toggle-btn' data-id='" . $id . "'>Toggle</button></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5'>0 results</td></tr>";
    }

    $conn->close();
    ?>
  </table>

  <script>
    // Steps 5 + 6: send the id to ToggleStatus.php, then update just that
    // one cell with the value the database sends back. No page reload.
    document.querySelectorAll('.toggle-btn').forEach(function (button) {
      button.addEventListener('click', function () {
        var id = button.dataset.id;
        button.disabled = true;

        fetch('ToggleStatus.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          if (data.ok) {
            document.getElementById('status-' + id).textContent = data.status;
          } else {
            alert('Could not toggle: ' + data.error);
          }
          button.disabled = false;
        })
        .catch(function (error) {
          alert('Request failed: ' + error);
          button.disabled = false;
        });
      });
    });
  </script>

</body>
</html>
