<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var Comments[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Comments", mappedBy="post")
     * @ORM\OrderBy({"dataComm" = "DESC"})
     */
    private $comments;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getData(): \DateTime
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     * @return Post
     */
    public function setData(\DateTime $data): Post
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Post
     */
    public function setText(string $text): Post
    {
        $this->text = $text;
        return $this;
    }

    public function __construct()
    {
         $this->data = new \DateTime();
         $this->title = '';
         $this->text = '';
         $this->comments = new ArrayCollection();
    }

    public function detShortText(): ?string
    {
       $paragraphs = explode("\n", $this->text, 2);
       return reset($paragraphs);
    }

    /**
     * @return Comments[]|ArrayCollection
     */
    public function getComments(): ? Collection
    {
        return $this->comments;
    }

    /**
     * @param Comments[]|ArrayCollection $comments
     * @return Post
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    public function countComm()
    {
        $count = count($this->comments);
        return $count;
    }
}
