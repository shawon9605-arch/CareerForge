<?php
$conn = new mysqli("localhost", "root", "", "careerforge");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>