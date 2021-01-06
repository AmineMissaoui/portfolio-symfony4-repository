<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PortfolioProject::class, mappedBy="category")
     */
    private $PortfolioProject;

    public function __construct()
    {
        $this->PortfolioProject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PortfolioProject[]
     */
    public function getPortfolioProject(): Collection
    {
        return $this->PortfolioProject;
    }

    public function addPortfolioProject(PortfolioProject $PortfolioProject): self
    {
        if (!$this->PortfolioProject->contains($PortfolioProject)) {
            $this->PortfolioProject[] = $PortfolioProject;
            $PortfolioProject->setCategory($this);
        }

        return $this;
    }

    public function removePortfolioProject(PortfolioProject $PortfolioProject): self
    {
        if ($this->PortfolioProject->removeElement($PortfolioProject)) {
            // set the owning side to null (unless already changed)
            if ($PortfolioProject->getCategory() === $this) {
                $PortfolioProject->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString()
        {
            return(string)$this->getName();
        }
}
