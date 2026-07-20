<?php
require 'db.php';

$name = $_GET['name'];
$age  = $_GET['age'];

$sql = "INSERT INTO MyGuests (id, name, age)
VALUES ('', '$name', '$age')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
