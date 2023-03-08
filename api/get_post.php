<?php

include('../imports.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('Invalid HTTP method. Use GET instead of ' . $_SERVER['REQUEST_METHOD']);
}

$id = $_REQUEST['id'] ?? 0;

if (empty($id)) {
    die('');
}

$post = Post::loadPost(new DatabaseEngine(), $id);

echo json_encode($post->toArray());
