<?php
$servername = "sql113.infinityfree.com";
$username = "if0_37547843";
$password = "Vishal449";
$dbname = "if0_37547843_e_uparjan";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
