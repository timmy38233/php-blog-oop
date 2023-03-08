<?php

include('../imports.php');

// delete_post.php?id=12345

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    die('');
}

(new Post(new DatabaseEngine()))->setId($id)->delete();

Post::loadPost(new DatabaseEngine(), 12345);
