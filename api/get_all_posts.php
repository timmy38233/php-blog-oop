<?php

include('../imports.php');

$posts = Post::loadAllPosts((new DatabaseEngine()));

echo json_encode(
    array_map(
        fn($post) => $post->toArray(),
        $posts)
);