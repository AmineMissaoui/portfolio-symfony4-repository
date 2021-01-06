<?php

namespace App\Entity;

use App\Repository\BlogPostCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostCategoryRepository::class)
 */
class BlogPostCategory
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
     * @ORM\OneToMany(targetEntity=blogPost::class, mappedBy="blogPostCategory")
     */
    private $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
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

    /**
     * @return Collection|blogPost[]
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(blogPost $post): self
    {
        if (!$this->post->contains($post)) {
            $this->post[] = $post;
            $post->setBlogPostCategory($this);
        }

        return $this;
    }

    public function removePost(blogPost $post): self
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getBlogPostCategory() === $this) {
                $post->setBlogPostCategory(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return(string)$this->getTitle();
    }
}
