<?php
// Ambil kategori
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ);

// Ambil 5 post terbaru
$latest = $conn->query("SELECT id, title, created_at FROM posts ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-lg-3" style="margin-top: 57px;">

    <!-- Navigation -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header fw-bold">Navigation</div>
        <div class="list-group list-group-flush">
            <a href="index.php" class="list-group-item list-group-item-action">🏠 Home</a>
            <a href="create-post.php" class="list-group-item list-group-item-action">➕ Create New Post</a>
        </div>
    </div>

    <!-- Categories -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header fw-bold">Categories</div>
        <div class="list-group list-group-flush">
            <?php if (count($categories) > 0): ?>
                <?php foreach ($categories as $cat): ?>
                    <a href="index.php?category=<?= $cat->id ?>" class="list-group-item list-group-item-action">
                        <?= htmlspecialchars($cat->name) ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-3 text-muted">No categories available.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Latest Posts -->
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Latest Posts</div>
        <div class="list-group list-group-flush">
            <?php if (count($latest) > 0): ?>
                <?php foreach ($latest as $row): ?>
                    <a href="single.php?id=<?= $row->id ?>" class="list-group-item list-group-item-action">
                        <div class="fw-semibold"><?= htmlspecialchars($row->title) ?></div>
                        <small class="text-muted"><?= date("M d, Y H:i", strtotime($row->created_at)) ?></small>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-3 text-muted">No posts yet.</div>
            <?php endif; ?>
        </div>
    </div>

</div>