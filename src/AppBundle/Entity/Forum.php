<?php
namespace AppBundle\Entity;

class Forum
{

    protected $title;

    protected $posts;

    public function __construct()
    {
        $this->posts = [];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }
}