<?php

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "jvfinal";


// Create connection

$conn = new mysqli($servername, $username, $pass, $dbname);

// check
if($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}
