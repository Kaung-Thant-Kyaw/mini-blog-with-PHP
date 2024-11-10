<?php
require_once("../db/Database.php");
require_once("../functions.php");

$query = "SELECT blogs.id AS blog_id, blogs.title, blogs.content, blogs.image, blogs.category_id, categories.name from blogs LEFT JOIN categories ON blogs.category_id = categories.id ORDER BY blogs.created_at DESC";

$blogs = $db->query($query);
