<?php
require '../config/config.php';
require '../includes/header.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT * FROM users WHERE username=:u OR email=:e");
        $check->execute([':u'=>$username, ':e'=>$email]);
        if ($check->rowCount() > 0) {
            $error = "Username or Email already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (:u,:e,:p)");
            $stmt->execute([':u'=>$username,':e'=>$email,':p'=>$hashed]);
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit;
        }
    }
}
?>
<div class="col-lg-4 offset-lg-4 mt-5">
    <div class="card">
        <div class="card-body">
            <h4>Register</h4>
            <?php if (!empty($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="post">
                <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
                <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
                <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control mb-2" required>
                <button name="register" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>