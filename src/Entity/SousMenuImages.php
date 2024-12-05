<?php

namespace App\Entity;

use App\Repository\SousMenuImagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SousMenuImagesRepository::class)]
#[Vich\Uploadable]
class SousMenuImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["sous_menu.index"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["sous_menu.index"])]
    private ?string $src = null;

    #[Vich\UploadableField('sous_menu', 'src')]
    private ?File $srcFile = null;

    #[ORM\ManyToOne(inversedBy: 'sousMenuImages')]
    private ?SousMenu $sous_menu = null;

    #[Groups(["sous_menu.index"])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(?string $src): static
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of srcFile
     */ 
    public function getSrcFile(): ?File
    {
        return $this->srcFile;
    }

    /**
     * Set the value of srcFile
     *
     * @return  self
     */ 
    public function setSrcFile(?File $srcFile): static
    {
        $this->srcFile = $srcFile;

        return $this;
    }
}
