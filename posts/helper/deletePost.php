<?php
require_once("../../db/Database.php");

$id = $_GET['id'];

// Delete Image
$oldImage = $db->query("SELECT image FROM blogs WHERE id=?", [$id])->fetchColumn();

if ($oldImage && file_exists("../../images" . $oldImage)) {
  unlink("../../images/" . $oldImage);
}

$query = "DELETE FROM blogs WHERE id=?";
$db->query($query, [$id]);

header("Location: ../list.php?success=3");
exit;
