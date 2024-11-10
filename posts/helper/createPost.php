<?php
require_once("../../db/Database.php");
require_once("../../functions.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

  // Form inputs
  $title = $_POST['title'] ?? '';
  $content = $_POST['content'] ?? '';
  $category_id = $_POST['category'] ?? '';
  $errors = [];

  // Validation
  if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
    $errors[] = "Photo is required!";
  }
  if (empty($title)) {
    $errors[] = "Title is required!";
  }
  if (empty($content)) {
    $errors[] = "Content is required!";
  }
  if (empty($category_id)) {
    $errors[] = "Category is required!";
  }

  if (!empty($errors)) {
    $errorQuery = http_build_query(['errors' => $errors]);
    header("Location: ../list.php?$errorQuery");
    exit;
  }

  // Handling File Upload
  if ($_FILES['image'] && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image'];
    $targetDir = "../../images/";
    $imageName = uniqid() . "ktk" . basename($image['name']);
    $targetFilePath = $targetDir . $imageName;
    if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
      $imagePath = $imageName;
    } else {
      $errors[] = "Failed to upload image.";
      $errorQuery = http_build_query(['errors' => $errors]);
      header("Location: ../list.php?$errorQuery");
      exit;
    }
  }


  // Inserting to the Database

  try {
    $query = "INSERT INTO blogs (title,content,image,category_id) VALUES (?,?,?,?)";
    $db->query($query, [$title, $content, $imagePath, $category_id]);

    header("Location: ../list.php?success=1");
    exit;
  } catch (PDOException $e) {
    $errors[] = "Database Error:" . $e->getMessage();
    $errorQuery = http_build_query(['errors' => $errors]);
    header("Location: ../list.php?$errorQuery");
    exit;
  }
}
