<?php

namespace App\Entity;

use App\Repository\MenuSousMenuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MenuSousMenuRepository::class)]
class MenuSousMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["sous_menu.index"])]
    private ?int $id = null;

    #[Groups(["sous_menu.index"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[Groups(["sous_menu.index"])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'menuSousMenus')]
    private ?SousMenu $sous_menu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): static
    {
        $this->activated = $activated;

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
