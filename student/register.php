<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/style.css">

<div class="auth-container">

    <div class="auth-left">
        <h1>CareerForge</h1>
        <p>Create your account and start building your career 💼</p>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <h2>Register</h2>

            <form method="POST">
                <input type="text" name="name" placeholder="👤 Full Name" required>
                <input type="email" name="email" placeholder="📧 Email" required>
                <input type="password" name="password" placeholder="🔒 Password" required>
                <button name="register">Create Account</button>
            </form>

            <p class="switch">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </div>
    </div>

</div>

<?php
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $conn->query("INSERT INTO students(name,email,password)
                  VALUES('$name','$email','$password')");

    echo "<p style='color:lightgreen;text-align:center;'>Registered Successfully!</p>";
}
?>