<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'werknemers';

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
