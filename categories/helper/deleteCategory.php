<?php
require_once("../../db/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
  $categoryId = $_POST['category_id'];
  $query = "DELETE FROM categories WHERE id=?";
  $db->query($query, [$categoryId]);

  header('Location: ../list.php');
  exit();
}
