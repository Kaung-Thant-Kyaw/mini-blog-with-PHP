<?php
$sql = "SELECT * FROM categories";
$categoryList = $db->query($sql)->fetchAll();
