<?php
include('../config/db.php');

$email = $_GET['email'];
$user = $conn->query("SELECT * FROM students WHERE email='$email'")->fetch_assoc();

$skills = explode(',', $user['skills']);
?>

<h1><?php echo $user['name']; ?></h1>
<p>Email: <?php echo $user['email']; ?></p>
<p>GPA: <?php echo $user['gpa']; ?></p>

<h3>Skills</h3>
<?php foreach($skills as $s): ?>
<span><?php echo trim($s); ?></span>
<?php endforeach; ?>