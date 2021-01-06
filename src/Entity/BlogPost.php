<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deprecatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flag;

    /**
     * @ORM\ManyToOne(targetEntity=BlogPostCategory::class, inversedBy="post")
     */
    private $blogPostCategory;

    /**
     * @ORM\OneToMany(targetEntity=BlogPostComment::class, mappedBy="blogPost")
     */
    private $blogPostComments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $blogPostImage;

    public function __construct()
    {
        $this->blogPostComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeprecatedAt(): ?\DateTimeInterface
    {
        return $this->deprecatedAt;
    }

    public function setDeprecatedAt(\DateTimeInterface $deprecatedAt): self
    {
        $this->deprecatedAt = $deprecatedAt;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getBlogPostCategory(): ?BlogPostCategory
    {
        return $this->blogPostCategory;
    }

    public function setBlogPostCategory(?BlogPostCategory $blogPostCategory): self
    {
        $this->blogPostCategory = $blogPostCategory;

        return $this;
    }

    /**
     * @return Collection|BlogPostComment[]
     */
    public function getBlogPostComments(): Collection
    {
        return $this->blogPostComments;
    }

    public function addBlogPostComment(BlogPostComment $blogPostComment): self
    {
        if (!$this->blogPostComments->contains($blogPostComment)) {
            $this->blogPostComments[] = $blogPostComment;
            $blogPostComment->setBlogPost($this);
        }

        return $this;
    }

    public function removeBlogPostComment(BlogPostComment $blogPostComment): self
    {
        if ($this->blogPostComments->removeElement($blogPostComment)) {
            // set the owning side to null (unless already changed)
            if ($blogPostComment->getBlogPost() === $this) {
                $blogPostComment->setBlogPost(null);
            }
        }

        return $this;
    }

    public function getBlogPostImage(): ?string
    {
        return $this->blogPostImage;
    }

    public function setBlogPostImage(string $blogPostImage): self
    {
        $this->blogPostImage = $blogPostImage;

        return $this;
    }
}
