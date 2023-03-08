<?php

class Post
{
    private int $id = 0;

    private string $title = '';

    private string $content = '';

    private Author $author;

    private DatabaseEngine $databaseEngine;

    public function __construct(DatabaseEngine $databaseEngine)
    {
        $this->id = hexdec(uniqid());
        $this->databaseEngine = $databaseEngine;
    }

    public static function loadPost(DatabaseEngine $databaseEngine, int $id): Post
    {
        try {
            $postData = json_decode($databaseEngine->readFile('post_' . $id), true);

            $post = (new Post($databaseEngine))
                ->setId($id)
                ->setTitle($postData['title'])
                ->setContent($postData['content'])
                ->setAuthor(new Author($postData['author']));
        } catch (Exception $e) {
            $post = null;
        }
        return $post;
    }

    public static function loadAllPosts(DatabaseEngine $databaseEngine): array {
        $files = $databaseEngine->getAllFileNames();
        $posts = [];
        foreach ($files as $file) {
            try {
                $postData = json_decode($databaseEngine->readFile($file), true);
                $post = (new Post($databaseEngine))
                    ->setId($postData['id'])
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setAuthor(new Author($postData['author']));
                $posts[] = $post;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return $posts;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function save()
    {
        $this->databaseEngine->createFile(
            'post_' . $this->id,
            json_encode([
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'author' => $this->author->getName(),
            ])
        );
    }

    public function toArray()
    {
        return ([
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->author->getName(),
        ]);
    }

    public function delete()
    {
        $this->databaseEngine->deleteFile('post_' . $this->id);
    }

}
