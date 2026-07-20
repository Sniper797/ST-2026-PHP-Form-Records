<?php
// Step 5: flip one record's status between 0 and 1.
// Called by JavaScript in index.php, replies with JSON.

$servername = "sql110.infinityfree.com";
$username   = "if0_42446707";
$password   = "THcMEoIDDLn";
$dbname     = "if0_42446707_myfrist";

header('Content-Type: application/json');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  echo json_encode(["ok" => false, "error" => "Connection failed: " . $conn->connect_error]);
  exit;
}

$id = $_POST['id'] ?? '';

if ($id === '') {
  echo json_encode(["ok" => false, "error" => "No record id was sent"]);
  exit;
}

// `1 - status` flips 0 into 1 and 1 into 0 inside MySQL itself,
// so we never have to read the old value first.
$sql = "UPDATE `user` SET status = 1 - status WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
  // Read the new value back so the page shows what is really stored
  $result = $conn->query("SELECT status FROM `user` WHERE id = '$id'");
  $row = $result->fetch_assoc();

  if ($row === null) {
    // The UPDATE "succeeded" but matched no rows, so this id does not exist.
    echo json_encode(["ok" => false, "error" => "No record with id $id"]);
  } else {
    echo json_encode(["ok" => true, "status" => $row["status"]]);
  }
} else {
  echo json_encode(["ok" => false, "error" => $conn->error]);
}

$conn->close();
?>
