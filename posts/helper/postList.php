<?php

// Fetch posts from the database
$query = "SELECT blogs.id AS blog_id, blogs.title, blogs.content, blogs.image, categories.name FROM blogs LEFT JOIN categories ON blogs.category_id=categories.id ORDER BY blogs.created_at DESC";
$posts = $db->query($query)->fetchAll();
