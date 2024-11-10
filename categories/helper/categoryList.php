<?php
$sql = "SELECT * FROM categories ORDER BY created_at DESC";
$categoryList = $db->query($sql)->fetchAll();
