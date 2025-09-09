<?php
require 'includes/header.php';
require 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

if (isset($_POST['create'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];

    if (!empty($title) && !empty($content) && !empty($category)) {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id, category_id) VALUES (:t,:c,:u,:cat)");
        $stmt->execute([
            ':t'=>$title,
            ':c'=>$content,
            ':u'=>$_SESSION['user_id'],
            ':cat'=>$category
        ]);
        header("Location: index.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
}

$cats = $conn->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="col-lg-8 offset-lg-2 mt-5">
    <div class="card">
        <div class="card-body">
            <h4>Create Post</h4>
            <?php if (!empty($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="post">
                <input type="text" name="title" placeholder="Post Title" class="form-control mb-2" required>
                <textarea name="content" rows="5" class="form-control mb-2" placeholder="Write your content" required></textarea>
                <select name="category" class="form-control mb-2" required>
                    <option value="">Choose Category</option>
                    <?php foreach ($cats as $c): ?>
                        <option value="<?= $c->id ?>"><?= htmlspecialchars($c->name) ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="create" class="btn btn-primary">Create</button>
                <button name="cancel" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
            </form>
        </div>
    </div>
</div>
<?php require 'includes/footer.php'; ?>