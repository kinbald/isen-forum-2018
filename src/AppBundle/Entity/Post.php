<?php
namespace AppBundle\Entity;

class Post
{

    protected $title;

    protected $author;

    protected $date;

    protected $content;

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}