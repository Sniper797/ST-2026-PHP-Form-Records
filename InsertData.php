<?php
$servername = "sql110.infinityfree.com";
$username   = "if0_42446707";
$password   = "THcMEoIDDLn";
$dbname     = "if0_42446707_myfrist";

// Only accept a real form submission. Opening this file directly in the
// browser is a GET with no data, which would otherwise insert a blank row.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: index.php");
  exit;
}

$name = $_POST['name'] ?? '';
$age  = $_POST['age'] ?? '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 3: store the submitted data. status starts at 0.
$sql = "INSERT INTO `user` (name, age, status)
VALUES ('$name', '$age', 0)";

if ($conn->query($sql) === TRUE) {
  // Go back to the form so the new row shows up in the table
  header("Location: index.php");
  exit;
} else {
  // Do not echo $sql back: it contains the submitted name, and printing it
  // unescaped would render any HTML the user typed.
  echo "Error saving record: " . htmlspecialchars($conn->error, ENT_QUOTES, 'UTF-8');
  echo "<br><a href='index.php'>Back to the form</a>";
}

$conn->close();
?>
