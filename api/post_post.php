<?php

include('../imports.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid HTTP method. Use POST instead of ' . $_SERVER['REQUEST_METHOD']);
}

$title = $_REQUEST['title'] ?? '';
$content = $_REQUEST['content'] ?? '';
$authorName = $_REQUEST['author_name'] ?? '';

if (in_array('', [$title, $content, $authorName])) {
    die('Invalid Input');
}

$post = (new Post(new DatabaseEngine()))
    ->setTitle($title)
    ->setContent($content)
    ->setAuthor(new Author($authorName));
    
$post->save();
