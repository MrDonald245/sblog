<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $text;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *
     * @var Post
     */
    private $post;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthor(): ? string {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Comment
     */
    public function setAuthor(string $author): ? Comment {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): ? string {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Comment
     */
    public function setText(string $text): Comment {
        $this->text = $text;
        return $this;
    }

    /**
     * @return Post
     */
    public function getPost(): ? Post {
        return $this->post;
    }

    /**
     * @param Post $post
     * @return Comment
     */
    public function setPost(Post $post): Comment {
        $this->post = $post;
        return $this;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function removePost(Post $post): bool {
        if ($this->post->getId() !== $post->getId()) {
            return false;
        }
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): ? DateTime {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(): void {
        $this->createdAt = new DateTime('now');
    }
}
