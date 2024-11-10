<?php
require_once("./layouts/header.php");
require_once("../db/Database.php");
require_once("./helper/categoryList.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
  echo "Invalid post ID!";
  exit;
}

$post = $db->query("SELECT * FROM blogs WHERE id = ?", [$id])->fetch();

if (!$post) {
  echo "Post not found!";
  exit;
}

?>

<div class="container">
  <form action="./helper/updatePost.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">

    <!-- Image upload with existing image preview -->
    <div class="mt-2">
      <img src="../../images/<?= htmlspecialchars($post['image']) ?>" id="output" width="150">
      <input type="file" name="image" class="form-control" onchange="loadFile(event)">
    </div>

    <!-- Title input with existing value -->
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?? htmlspecialchars($_POST['title']) ?>" class="form-control" placeholder="Enter Title">

    <!-- Content textarea with existing value -->
    <textarea cols="30" rows="10" name="content" class="form-control" placeholder="Enter Your Content"><?= htmlspecialchars($post['content']) ?? htmlspecialchars($_POST['content']) ?></textarea>

    <!-- Category dropdown with selected category -->
    <select name="category" class="form-control">
      <?php foreach ($categoryList as $category) : ?>
        <option value="<?= $category['id'] ?>" <?= $post['category_id'] == $category['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($category['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="submit" value="Update" class="btn btn-primary mt-3">
  </form>

</div>

<?php require_once("./layouts/footer.php") ?>