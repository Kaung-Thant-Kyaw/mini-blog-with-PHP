<?php
require_once("../db/Database.php");
require_once("./layouts/header.php");

$id = $_GET['id'];

$query = "SELECT blogs.title, blogs.content, blogs.image, blogs.created_at, categories.name AS category_name 
          FROM blogs 
          LEFT JOIN categories ON blogs.category_id = categories.id 
          WHERE blogs.id = ?";
$post = $db->query($query, [$id])->fetch();

?>

<div class="container mt-5">
  <div class="card">
    <?php if ($post['image']) : ?>
      <img src="../../images/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="card-img-top">
    <?php endif ?>
    <div class="card-body">
      <h2 class="card-title"><?= htmlspecialchars($post['title']) ?></h2>
      <p class="card-text"><strong>Category:</strong> <?= htmlspecialchars($post['category_name'] ?? 'Uncategorized') ?></p>
      <p class="card-text"><strong>Posted on:</strong> <?= date("F j, Y", strtotime($post['created_at'])) ?></p>
      <hr>
      <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
      <a href="list.php" class="btn btn-primary mt-3">Back to Posts</a>
    </div>
  </div>
</div>

<?php require_once("./layouts/footer.php"); ?>