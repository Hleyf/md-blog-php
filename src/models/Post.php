<?php

namespace Hleyf\Blog\Models;

use League\CommonMark\CommonMarkConverter;
use Error;

//TODO: Refactor class name to "Entry" or "Article" so it won't be confused with the HTTP POST method
class Post{

    public function __construct(private string $file){}

    public function getContent() {
        $converter = new CommonMarkConverter(['html_input' => 'escape']);

        // TODO: It must be a more elegant way to do this
        if(!file_exists($this->getFileName())){
            if(!file_exists($this->getFileNameWithoutDash())){
                throw new Error('File not found');
            }
        }

        $stream = fopen($this->getFileName(), 'r');
        $content = fread($stream, filesize($this->getFileName()));

        return $converter->convert($content);

        
    }

    public static function getPosts(){
        $files = scandir(Url::getPath() . '/entries');
        $posts = [];
        foreach ($files as $file) {
            // check if the file is a markdown file
            if(strpos($file,'.md') > 0){
                $post = new Post($file);
                array_push($posts, $post);
            }
        }

        return $posts;
    }

    public function getFileName(){
        $root = Url::getPath();
        
        return "{$root}/entries/{$this->file}";
    }

    
    private function getFileNameWithoutDash(){
        $title =  str_replace('-', ' ', $this->file);
        $this->file = $title;
        return $title;
    }

    //Used in the home page to get the URL of the post
    public function getPostURL($baseUrl = "http://localhost/md-blog-php/", $extension = ".md"){
        $url = substr($this->file, 0, strpos($this->file, $extension));
        $title = str_replace(' ', '-', $url);
        return "{$baseUrl}?post={$title}";
    }

    //Used in the home page to get the title of the post
    public function getTitle() {
        $title = $this->file;
        $title =  str_replace('.md', '', $title);
        $title =  str_replace('-', ' ', $title);
        return $title;
    }
}