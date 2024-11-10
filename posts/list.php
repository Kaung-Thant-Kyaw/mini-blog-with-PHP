<?php
require_once("./layouts/header.php");
require_once("../functions.php");
require_once("../db/Database.php");
require_once("./helper/categoryList.php");
require_once("./helper/postList.php");
$errors = $_GET['errors'] ?? [];
?>

<div class="container">
  <div class="row">
    <div class="col-4 p-5">
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach ($errors as $error) : ?>
              <li style="list-style: none;"><?= $error ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
          <?php if ($_GET['success'] == 1): ?>
            Created post successfully!
          <?php elseif ($_GET['success'] == 2): ?>
            Updated post successfully!
          <?php elseif ($_GET['success'] == 3): ?>
            Deleted post successfully!
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <form action="./helper/createPost.php" method="post" enctype="multipart/form-data">
        <div class="">
          <div class="">
            <!-- Image preview (if exists) -->
            <?php if (isset($_GET['image'])) : ?>
              <img src="../../images/<?= htmlspecialchars($_GET['image']) ?>" id="output" class="w-100">
            <?php endif; ?>
          </div>
          <div class="mt-2">
            <!-- Input for image file (no need for value attribute for file input) -->
            <input type="file" name="image" id="image" class="form-control" value="<?= $_GET['image'] ?? '' ?>" onchange="loadFile(event)">
          </div>
        </div>
        <div class="mt-2">
          <!-- Title input (remains old value if validation fails) -->
          <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?= htmlspecialchars($_GET['title'] ?? '') ?>">
        </div>
        <div class="mt-2">
          <!-- Content textarea (remains old value if validation fails) -->
          <textarea cols="30" rows="10" name="content" id="content" class="form-control" placeholder="Enter Your Content"><?= htmlspecialchars($_GET['content'] ?? '') ?></textarea>
        </div>
        <div class="mt-2">
          <!-- Category dropdown (remains old value if validation fails) -->
          <select name="category" id="category" class="form-control">
            <option value="">Choose Category</option>
            <?php foreach ($categoryList as $category) : ?>
              <option value="<?= $category['id'] ?>" <?= isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mt-2">
          <input type="submit" value="Create" class="btn btn-primary">
        </div>
      </form>


    </div>
    <div class="col p-5">
      <div class="row">
        <?php foreach ($posts as $post) : ?>
          <div class="col-4 me-2">
            <div class="card mb-4" style="min-width: 14rem;">
              <?php if ($post['image']) : ?>
                <img src="../../images/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-100 mb-3">
              <?php endif ?>
              <div class="card-body">
                <h4 class="card-title"><?= htmlspecialchars($post['title']) ?></h4>
                <p class="card-text"><?= htmlspecialchars(mb_strimwidth($post['content'], 0, 60, '...')) ?></p>
                <a href="./editPost.php?id=<?= $post['blog_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="./helper/deletePost.php?id=<?= $post['blog_id'] ?>" onclick="return confirm('Are you sure you want to delete this post?');" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                <p><small>Category: <?= htmlspecialchars($post['name']) ?></small></p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>

<?php require_once("./layouts/footer.php") ?>