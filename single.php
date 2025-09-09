<?php
require 'includes/header.php';
require 'config/config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid post ID.</div>";
    require 'includes/footer.php';
    exit;
}

$post_id = (int) $_GET['id'];

// Ambil data post + user + category
$stmt = $conn->prepare("
    SELECT p.id, p.title, p.content, p.created_at,
           u.username, c.name AS category
    FROM posts p
    JOIN users u ON p.user_id = u.id
    JOIN categories c ON p.category_id = c.id
    WHERE p.id = :id
");
$stmt->execute([':id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_OBJ);

if (!$post) {
    echo "<div class='alert alert-warning'>Post not found.</div>";
    require 'includes/footer.php';
    exit;
}

// Tambah komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<div class='alert alert-danger'>You must login to comment.</div>";
    } else {
        $comment = trim($_POST['comment']);
        if (!empty($comment)) {
            $stmt = $conn->prepare("INSERT INTO comments (content, user_id, post_id) VALUES (:content, :user_id, :post_id)");
            $stmt->execute([
                ':content' => $comment,
                ':user_id' => $_SESSION['user_id'],
                ':post_id' => $post_id
            ]);
            header("Location: single.php?id=" . $post_id);
            exit;
        } else {
            echo "<div class='alert alert-warning'>Comment cannot be empty.</div>";
        }
    }
}

// Ambil komentar untuk post ini
$stmt = $conn->prepare("
    SELECT cm.content, cm.created_at, u.username
    FROM comments cm
    JOIN users u ON cm.user_id = u.id
    WHERE cm.post_id = :post_id
    ORDER BY cm.created_at DESC
");
$stmt->execute([':post_id' => $post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Main Content -->
<div class="col-lg-9 mb-3" style="margin-top: 57px;">
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($post->title) ?></h3>
            <p class="text-muted">
                Posted on <?= date("M d, Y H:i", strtotime($post->created_at)) ?> 
                by <strong><?= htmlspecialchars($post->username) ?></strong> 
                in <em><?= htmlspecialchars($post->category) ?></em>
            </p>
            <p><?= nl2br(htmlspecialchars($post->content)) ?></p>
        </div>
    </div>

    <h5>Comments (<?= count($comments) ?>)</h5>
    <?php if (count($comments) > 0): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="card mb-2">
                <div class="card-body">
                    <p><?= nl2br(htmlspecialchars($comment->content)) ?></p>
                    <small class="text-muted">
                        By <?= htmlspecialchars($comment->username) ?> 
                        on <?= date("M d, Y H:i", strtotime($comment->created_at)) ?>
                    </small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info mt-3">
            Please <a href="auth/login.php">login</a> to write a comment.
        </div>
    <?php endif; ?>
</div>
<!-- /Main Content -->

<?php require 'includes/sidebar.php'; ?>
<?php require 'includes/footer.php'; ?>
