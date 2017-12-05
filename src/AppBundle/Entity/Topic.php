<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicRepository")
 */
class Topic
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="creation", type="datetimetz")
     *
     * @var \DateTime
     */
    private $creation;

    /**
     * @ORM\Column(name="author", type="string", length=255)
     *
     * @var string
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="topics")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     *
     * @var Forum
     */
    private $forum;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="topic", cascade={"remove"})
     *
     * @var Collection
     */
    private $posts;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set creation
     *
     * @param \DateTime $creation
     *
     * @return Topic
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
        
        return $this;
    }

    /**
     * Get creation
     *
     * @return \DateTime
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Topic
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        
        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set forum
     *
     * @param \AppBundle\Entity\Forum $forum
     *
     * @return Topic
     */
    public function setForum(\AppBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;
        
        return $this;
    }

    /**
     * Get forum
     *
     * @return \AppBundle\Entity\Forum
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add post
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Topic
     */
    public function addPost(\AppBundle\Entity\Post $post)
    {
        $this->posts[] = $post;
        
        return $this;
    }

    /**
     * Remove post
     *
     * @param \AppBundle\Entity\Post $post
     */
    public function removePost(\AppBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
