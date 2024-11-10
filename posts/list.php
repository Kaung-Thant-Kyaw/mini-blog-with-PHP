<?php
require_once("./layouts/header.php");
require_once("../db/Database.php");
require_once("./helper/categoryList.php");
require_once("./helper/BlogList.php");

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
      <?php if (isset($_GET['success']) && (int)$_GET['success'] === 1) : ?>
        <div class="alert alert-success">
          Created post successfully!
        </div>
      <?php endif ?>
      <form action="./helper/createPost.php" method="post" enctype="multipart/form-data">
        <div class="">
          <div class="">
            <img src="" id="output" class="w-100">
          </div>
          <div class="mt-2">
            <input type="file" name="image" id="image" class="form-control" onchange="loadFile(event)">
          </div>
        </div>
        <div class="mt-2">
          <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
        </div>
        <div class="mt-2">
          <textarea cols="30" rows="10" name="content" id="content" class="form-control" placeholder="Enter Your Content"></textarea>
        </div>
        <div class="mt-2">
          <select name="category" id="category" class="form-control">
            <option value="">Choose Category</option>
            <?php foreach ($categoryList as $category) : ?>
              <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mt-2">
          <input type="submit" value="Create" class="btn btn-primary">
        </div>
      </form>
    </div>
    <div class="col"></div>
  </div>
</div>

<?php require_once("./layouts/footer.php") ?>