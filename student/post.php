<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_SESSION['email'] ?? '';
$content = $_POST['content'] ?? '';

if (!empty($content)) {

    $stmt = $conn->prepare("INSERT INTO posts (email, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $content);
    $stmt->execute();
}

header("Location: community.php");
exit();
?>