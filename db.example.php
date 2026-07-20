<?php
// Copy this file to `db.php` and fill in your real InfinityFree credentials.
// `db.php` is listed in .gitignore so the password never reaches GitHub.

$servername = "sqlXXX.infinityfree.com";   // MySQL Hostname from the InfinityFree panel
$username   = "if0_XXXXXXXX";              // MySQL Username
$password   = "YOUR_PASSWORD_HERE";        // MySQL Password
$dbname     = "if0_XXXXXXXX_myfrist";      // Database Name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
