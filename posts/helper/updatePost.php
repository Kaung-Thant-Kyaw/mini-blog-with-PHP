<?php
require_once("../../db/Database.php");
require_once("../../functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title = $_POST['title'] ?? null;
  $content = $_POST['content'] ?? null;
  $category_id = $_POST['category'];
  $fieldsToUpdate = [];
  $params = [];

  // Validation
  if (empty($title) && empty($content) && empty($_FILES['image']['name'])) {
    header("Location: ../editPost.php?id=$id&error=1");
    exit;
  }

  // Add fields to update if they are not empty
  if ($title) {
    $fieldsToUpdate[] = "title = ?";
    $params[] = $title;
  }
  if ($content) {
    $fieldsToUpdate[] = "content = ?";
    $params[] = $content;
  }
  if ($category_id) {
    $fieldsToUpdate[] = "category_id = ?";
    $params[] = $category_id;
  }

  // Image update
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    // delete old image 
    $oldImage = $db->query("SELECT image FROM blogs WHERE id=?", [$id])->fetchColumn();
    if ($oldImage && file_exists("../../images/" . $oldImage)) {
      unlink("../../images/" . $oldImage);
    }

    // upload new image
    $image = $_FILES['image'];
    $targetDir = "../../images/";
    $imageName = uniqid() . "_ktk_" . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $targetDir . $imageName);

    $fieldsToUpdate[] = "image = ?";
    $params[] = $imageName;
  }

  // update posts if fields to update exists
  if (!empty($fieldsToUpdate)) {
    $params[] = $id;
    $query = "UPDATE blogs SET " . implode(", ", $fieldsToUpdate) . " WHERE id = ?";
    $db->query($query, $params);
    header("Location: ../list.php?success=2");
    exit;
  } else {
    header("Location: ../editPost.php?id=$id&error=1");
    exit;
  }
}
