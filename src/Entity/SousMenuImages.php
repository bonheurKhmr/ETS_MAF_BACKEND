<?php

namespace App\Entity;

use App\Repository\SousMenuImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousMenuImagesRepository::class)]
class SousMenuImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $src = null;

    #[ORM\ManyToOne(inversedBy: 'sousMenuImages')]
    private ?SousMenu $sous_menu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;

        return $this;
    }

    public function getSousMenu(): ?SousMenu
    {
        return $this->sous_menu;
    }

    public function setSousMenu(?SousMenu $sous_menu): static
    {
        $this->sous_menu = $sous_menu;

        return $this;
    }
}
