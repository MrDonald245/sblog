<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks
 */
class Post
{
    private const PREVIEW_LENGTH = 300;

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
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $title;

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
     * @ORM\Column(type="datetime", name="updated_at")
     *
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getAuthor(): ? string {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Post
     */
    public function setAuthor(string $author): Post {
        $this->author = $author;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ? string {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getText(): ? string {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Post
     */
    public function setText(string $text): Post {
        $this->text = $text;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps() {
        $this->updatedAt = new DateTime('now');

        if ($this->createdAt == null) {
            $this->createdAt = new DateTime('now');
        }
    }

    /**
     * Makes a post's text up to Post::PREVIEW_LENGTH symbols,
     * showing the last sentence.
     *
     * @return string
     */
    public function getTextPreview(): string {
        $result = $this->text;
        $result = substr($result, 0, self::PREVIEW_LENGTH);

        if (strpos($result, '.')) {
            $result = explode('.', $result);
            array_pop($result);
            $result = implode('', $result);
            $result .= '.';
        }

        return $result;
    }

    /**
     * Simply shows if a post's text long enough to be previewed.
     *
     * @return bool
     */
    public function isPreviewable(): bool {
        return strlen($this->text) >= self::PREVIEW_LENGTH;
    }
}