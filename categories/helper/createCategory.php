<?php
require_once("../../db/Database.php");
session_start();

if (isset($_POST['createBtn'])) {
  $categoryName = trim($_POST['categoryName'] ?? '');

  if (!empty($categoryName)) {
    try {
      // Prepare and execute the query to insert the category name
      $query = "INSERT INTO categories (name) VALUES (?)";
      $db->query($query, [$categoryName]);

      // Redirect to the list page upon successful creation
      header('Location: ../list.php');
      exit();
    } catch (Exception $e) {
      // Log or handle the exception as needed
      $_SESSION['error'] = "Failed to create category: " . $e->getMessage();
      header('Location: ../list.php');
      exit();
    }
  } else {
    // Redirect back to the form with an error flag
    header('Location: ../list.php?error=missing_name');
    exit();
  }
}
