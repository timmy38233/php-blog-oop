<?php

include('../imports.php');

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$authorName = $_POST['author_name'] ?? '';

if (in_array('', [$title, $content, $authorName])) {
    die('Invalid Input');
}

$post = (new Post(new DatabaseEngine()))
    ->setTitle($title)
    ->setContent($content)
    ->setAuthor(new Author($authorName));
    
$post->save();
