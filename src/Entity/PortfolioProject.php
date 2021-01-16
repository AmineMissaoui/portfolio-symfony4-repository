<?php

namespace App\Entity;

use App\Repository\PortfolioProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PortfolioProjectRepository::class)
 */
class PortfolioProject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ invalide !")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Champ invalide !")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Champ invalide !")
     */
    private $link;


    /**
     * @ORM\OneToMany(targetEntity=PortfolioImages::class, mappedBy="PortfolioProject", orphanRemoval=true, cascade={"persist"})
     */
    private $portfolioImages;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ invalide !")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="PortfolioProject")
     * @Assert\NotBlank(message="Champ invalide !")
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date(message="Champ invalide !")
     */
    private $creationDate;


    public function __construct()
    {
        $this->portfolioImages = new ArrayCollection();
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }


    /**
     * @return Collection|PortfolioImages[]
     */
    public function getPortfolioImages(): Collection
    {
        return $this->portfolioImages;
    }

    public function addPortfolioImage(PortfolioImages $portfolioImage): self
    {
        if (!$this->portfolioImages->contains($portfolioImage)) {
            $this->portfolioImages[] = $portfolioImage;
            $portfolioImage->setPortfolioProject($this);
        }

        return $this;
    }

    public function removePortfolioImage(PortfolioImages $portfolioImage): self
    {
        if ($this->portfolioImages->removeElement($portfolioImage)) {
            // set the owning side to null (unless already changed)
            if ($portfolioImage->getPortfolioProject() === $this) {
                $portfolioImage->setPortfolioProject(null);
            }
        }

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

}
