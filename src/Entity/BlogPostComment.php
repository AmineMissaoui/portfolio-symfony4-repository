<?php

namespace App\Entity;

use App\Repository\BlogPostCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostCommentRepository::class)
 */
class BlogPostComment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity=blogPost::class, inversedBy="blogPostComments")
     */
    private $blogPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getEnabled(): ?string
    {
        return $this->enabled;
    }

    public function setEnabled(string $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getBlogPost(): ?blogPost
    {
        return $this->blogPost;
    }

    public function setBlogPost(?blogPost $blogPost): self
    {
        $this->blogPost = $blogPost;

        return $this;
    }
}
