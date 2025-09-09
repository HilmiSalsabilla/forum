<?php 
    require 'includes/header.php'; 
    require 'config/config.php';

    $query = $conn->query("
        SELECT p.id, p.title, p.created_at, u.username, c.name AS category,
        COUNT(cm.id) AS comment_count
        FROM posts p
        JOIN users u ON p.user_id = u.id
        JOIN categories c ON p.category_id = c.id
        LEFT JOIN comments cm ON p.id = cm.post_id
        GROUP BY p.id, p.title, p.created_at, u.username, c.name
        ORDER BY p.created_at DESC
    ");
    $posts = $query->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-lg-9 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>All Posts</h3>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="create-post.php" class="btn btn-success">+ Create New Post</a>
        <?php endif; ?>
    </div>
    <?php foreach ($posts as $post): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><a href="single.php?id=<?= $post->id ?>" class="text-primary"><?= htmlspecialchars($post->title) ?></a></h5>
                <small>Posted <?= date("M d, Y H:i", strtotime($post->created_at)) ?> by <?= htmlspecialchars($post->username) ?></small>
                <p class="text-muted"><?= htmlspecialchars($post->category) ?> | <?= $post->comment_count ?> Replies</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require 'includes/sidebar.php'; ?>
<?php require 'includes/footer.php'; ?>
