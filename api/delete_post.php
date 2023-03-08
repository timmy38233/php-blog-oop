<?php

include('../imports.php');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    die('Invalid HTTP method. Use DELETE instead of ' . $_SERVER['REQUEST_METHOD']);
}

$id = $_REQUEST['id'] ?? 0;

if (empty($id)) {
    die('');
}

(new Post(new DatabaseEngine()))->setId($id)->delete();

Post::loadPost(new DatabaseEngine(), 12345);
