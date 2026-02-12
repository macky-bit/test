<?php
$conn = new mysqli("localhost", "root", "", "info_management_db");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>