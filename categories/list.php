<?php
require_once("./layouts/header.php");
require_once("../db/Database.php");
require_once("../functions.php");
session_start();

// Show Category List 
require_once("./helper/categoryList.php");

?>

<div class="container mt-5">
  <div class="row">
    <div class="col-4">
      <div class="">
        <form action="./helper/createCategory.php" method="post">
          <div class="mb-3">
            <input type="text" name="categoryName" id="" class="form-control"
              placeholder="Enter Category Name">
            <!-- Check for an error query parameter and display the message if present -->
            <?php if (isset($_GET['error']) && $_GET['error'] === 'missing_name') : ?>
              <small class='text-danger'>
                Category name is required!
              </small>
            <?php endif ?>
          </div>
          <div class="">
            <input type="submit" value="Create" name="createBtn" class="btn btn-secondary">
          </div>
        </form>
      </div>
    </div>
    <div class="col">
      <?php foreach ($categoryList as $category) : ?>
        <div class="shadow-sm bg-light p-3 mb-3 d-flex justify-content-between align-items-center">
          <!-- Display category name and Edit button -->
          <span class="category-name" id="category-name-<?= htmlspecialchars($category['id']) ?>">
            <?= htmlspecialchars($category['name']) ?>
          </span>

          <!-- Form for editing category name -->
          <form action="./helper/updateCategory.php" method="POST" class="d-none" id="edit-form-<?= htmlspecialchars($category['id']) ?>">
            <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['id']) ?>">
            <input type="text" name="category_name" value="<?= htmlspecialchars($category['name']) ?>" class="form-control form-control-sm" required>
            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm(<?= htmlspecialchars($category['id']) ?>)">Cancel</button>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
          </form>

          <!-- Edit and Delete Buttons -->
          <div>
            <button class="btn btn-warning btn-sm" onclick="toggleEditForm(<?= htmlspecialchars($category['id']) ?>)">
              <i class="fa fa-pencil-alt"></i> Edit
            </button>
            <form action="./helper/deleteCategory.php" method="POST" style="display:inline;">
              <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['id']) ?>">
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i> Delete
              </button>
            </form>
          </div>
        </div>
      <?php endforeach ?>
    </div>

    <script>

    </script>

  </div>
</div>

<?php
require_once("./layouts/footer.php");
?>