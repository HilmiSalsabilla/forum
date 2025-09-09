<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/forum/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-sm">
        <a class="navbar-brand" href="/forum/index.php">Forum</a>
        <div>
            <ul class="navbar-nav ms-auto">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/forum/auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/forum/auth/register.php">Register</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/forum/create-post.php">Create Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="/forum/auth/logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container-sm mt-3">
  <div class="row">
