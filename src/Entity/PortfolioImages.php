<?php

namespace App\Entity;

use App\Repository\PortfolioImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortfolioImagesRepository::class)
 */
class PortfolioImages 
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
     * @ORM\ManyToOne(targetEntity=PortfolioProject::class, inversedBy="portfolioImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PortfolioProject;

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

    public function getPortfolioProject(): ?PortfolioProject
    {
        return $this->PortfolioProject;
    }

    public function setPortfolioProject(?PortfolioProject $PortfolioProject): self
    {
        $this->PortfolioProject = $PortfolioProject;

        return $this;
    }
}
