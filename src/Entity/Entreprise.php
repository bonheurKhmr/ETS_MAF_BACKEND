<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[Vich\Uploadable]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['entreprise.index'])]
    private ?int $id = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $logo = null;

    #[Vich\UploadableField('logo', 'logo')]
    private ?File $logoFile = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column]
    private ?bool $activated = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $litle_name = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $rccm = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $Pays = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $province = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $vile = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[Groups(['entreprise.index'])]
    #[ORM\Column(length: 255)]
    private ?string $avenue = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLitleName(): ?string
    {
        return $this->litle_name;
    }

    public function setLitleName(string $litle_name): static
    {
        $this->litle_name = $litle_name;

        return $this;
    }

    /**
     * Get the value of logoFile
     */ 
    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    /**
     * Set the value of logoFile
     *
     * @return  self
     */ 
    public function setLogoFile(?File $logoFile): static
    {
        $this->logoFile = $logoFile;

        return $this;
    }

    public function getRccm(): ?string
    {
        return $this->rccm;
    }

    public function setRccm(string $rccm): static
    {
        $this->rccm = $rccm;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getVile(): ?string
    {
        return $this->vile;
    }

    public function setVile(string $vile): static
    {
        $this->vile = $vile;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getAvenue(): ?string
    {
        return $this->avenue;
    }

    public function setAvenue(string $avenue): static
    {
        $this->avenue = $avenue;

        return $this;
    }
}
