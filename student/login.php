<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* LOGIN LOGIC FIRST (IMPORTANT) */
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = $conn->query("SELECT * FROM students WHERE email='$email' AND password='$password'");
    
    if($result && $result->num_rows > 0){
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit(); // VERY IMPORTANT
    } else {
        $error = "Invalid Login";
    }
}
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="auth-container">

    <div class="auth-left">
        <h1>CareerForge</h1>
        <p>Welcome back! Continue your journey to success 🚀</p>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <h2>Login</h2>

            <?php if(isset($error)): ?>
                <p style="color:red;text-align:center;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" placeholder="📧 Email" required>
                <input type="password" name="password" placeholder="🔒 Password" required>
                <button name="login">Login</button>
            </form>

            <p class="switch">
                Don't have an account? <a href="register.php">Register</a>
            </p>
        </div>
    </div>

</div>