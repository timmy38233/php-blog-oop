<?php

class Post {
    private int $id = 0;

    private string $title = '';

    private string $content = '';

    private Author $author;

    private DatabaseEngine $databaseEngine;

    public function __construct(DatabaseEngine $databaseEngine) {
        $this->id = hexdec(uniqid());
        $this->databaseEngine = $databaseEngine;
    }

    public function save() {
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

    public function delete() {
        $this->databaseEngine->deleteFile('post_' . $this->id);
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

    public function setAuthor(Author $author): self {
        $this->author = $author;
        return $this;
    }

    public static function loadPost(DatabaseEngine $databaseEngine, int $id): Post {
        // read a file from db -> dbEngine should return json from file
        // this func shpukd then parse that json and init a Post obj
        // return that Post obj
    }

}
