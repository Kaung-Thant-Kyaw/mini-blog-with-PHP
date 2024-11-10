<?php
require_once("../../db/Database.php");
require_once("../../functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'], $_POST['category_name'])) {
  $categoryId = $_POST['category_id'];
  $categoryName = $_POST['category_name'];

  $query = "UPDATE categories SET name=? WHERE id=?";
  $db->query($query, [$categoryName, $categoryId]);

  header('Location: ../list.php');
  exit();
}
