<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
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
    private $dataComm;

    /**
     * @var string
     * @ORM\Column(type="string", length=250)
     */
    private $nikName;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $textComm;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Comments
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataComm(): \DateTime
    {
        return $this->dataComm;
    }

    /**
     * @param \DateTime $dataComm
     * @return Comments
     */
    public function setDataComm(\DateTime $dataComm): Comments
    {
        $this->dataComm = $dataComm;
        return $this;
    }

    /**
     * @return string
     */
    public function getNikName(): string
    {
        return $this->nikName;
    }

    /**
     * @param string $nikName
     * @return Comments
     */
    public function setNikName(string $nikName): Comments
    {
        $this->nikName = $nikName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextComm(): string
    {
        return $this->textComm;
    }

    /**
     * @param string $textComm
     * @return Comments
     */
    public function setTextComm(string $textComm): Comments
    {
        $this->textComm = $textComm;
        return $this;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     * @return Comments
     */
    public function setPost(Post $post): Comments
    {
        $this->post = $post;
        return $this;
    }


    public function __construct()
    {
        $this->dataComm = new \DateTime();
        $this->nikName = '';
        $this->textComm = '';
    }

}
