<?php
require '../config/config.php';
require '../includes/header.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:e LIMIT 1");
    $stmt->execute([':e'=>$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Invalid login credentials.";
    }
}
?>
<div class="col-lg-4 offset-lg-4 mt-5">
    <div class="card">
        <div class="card-body">
            <h4>Login</h4>
            <?php if (!empty($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="post">
                <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
                <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
                <button name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-2">No account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>
