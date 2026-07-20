<?php
$servername = "sql110.infinityfree.com";
$username   = "if0_42446707";
$password   = "THcMEoIDDLn";
$dbname     = "if0_42446707_myfrist";

$name = $_POST['name'];
$age  = $_POST['age'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 3: store the submitted data. status starts at 0.
$sql = "INSERT INTO MyGuests (name, age, status)
VALUES ('$name', '$age', 0)";

if ($conn->query($sql) === TRUE) {
  // Go back to the form so the new row shows up in the table
  header("Location: index.php");
  exit;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
