<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_SESSION['email'];

/* =========================
   UPDATE SKILLS
========================= */
if (isset($_POST['skills'])) {

    $skills = $_POST['skills'];

    // Clean + format skills
    $skillsArray = array_filter(array_map('trim', explode(',', $skills)));
    $finalSkills = implode(', ', array_unique($skillsArray));

    $conn->query("UPDATE students 
                  SET skills='$finalSkills' 
                  WHERE email='$email'");
}


/* =========================
   UPDATE PROFILE (INTERESTS + GPA)
========================= */
if (isset($_POST['interests']) || isset($_POST['gpa'])) {

    $interests = $_POST['interests'] ?? '';
    $gpa = $_POST['gpa'] ?? '';

    $conn->query("UPDATE students 
                  SET interests='$interests', gpa='$gpa' 
                  WHERE email='$email'");
}


/* =========================
   REDIRECT BACK
========================= */
header("Location: dashboard.php?success=1");
exit();
?>