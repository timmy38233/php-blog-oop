<?php

class DatabaseEngine
{

    private string $docRoot;

    public function __construct()
    {
        $this->docRoot = $_SERVER['DOCUMENT_ROOT'] . '/filestore/';
    }

    public function createFile(string $fileName, string $content): bool
    {
        try {
            $file = fopen($this->docRoot . $fileName, 'w');
            fwrite($file, $content);
            fclose($file);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function readFile(string $fileName): string
    {
        try {
            $data = file_get_contents($this->docRoot . $fileName);
        } catch (Exception $e) {
            $data = null;
        }
        return $data;
    }

    public function getAllFileNames(): array
    {
        $files = [];
        foreach(new DirectoryIterator($this->docRoot) as $item) {
            if ($item->isFile()) {
                $files[] =  $item->getFilename();
            }
        }
        return $files;
    }

    public function deleteFile(string $fileName)
    {
        unlink($this->docRoot . $fileName);
    }
}
