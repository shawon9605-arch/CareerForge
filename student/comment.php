<?php
include('../config/db.php');

$comment = $_POST['comment'] ?? '';
$post_id = $_POST['post_id'] ?? 0;

if (!empty($comment)) {

    $stmt = $conn->prepare("INSERT INTO comments (post_id, email, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $post_id, $_SESSION['email'], $comment);
    $stmt->execute();
}

header("Location: community.php");
exit();
?>