<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Attribute\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[Vich\Uploadable]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["service.index"])]
    private ?int $id = null;

    #[Groups(["service.index"])]
    #[ORM\Column(length: 100)]
    private ?string $service = null;

    #[Groups(["service.index"])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Groups(["service.index"])]
    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[Vich\UploadableField("service", "image")]
    private ?File $imageFile = null;

    #[ORM\Column]
    private ?bool $is_activated = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    private ?SerciveFiles $file = null;

    /**
     * @var Collection<int, SerciveFiles>
     */
    #[Groups(["service.index"])]
    #[ORM\OneToMany(targetEntity: SerciveFiles::class, mappedBy: 'service', cascade: ['persist'])]
    private Collection $serciveFiles;

    public function __construct()
    {
        $this->serciveFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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
        return $this->is_activated;
    }

    public function setActivated(bool $is_activated): static
    {
        $this->is_activated = $is_activated;

        return $this;
    }

    public function setIsActivated(bool $is_activated): static
    {
        $this->is_activated = $is_activated;

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile():?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile(?File $imageFile):static
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getFile(): ?SerciveFiles
    {
        return $this->file;
    }

    public function setFile(?SerciveFiles $file): static
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection<int, SerciveFiles>
     */
    public function getSerciveFiles(): Collection
    {
        return $this->serciveFiles;
    }

    public function addSerciveFile(SerciveFiles $serciveFile): static
    {
        if (!$this->serciveFiles->contains($serciveFile)) {
            $this->serciveFiles->add($serciveFile);
            $serciveFile->setService($this);
        }

        return $this;
    }

    public function removeSerciveFile(SerciveFiles $serciveFile): static
    {
        if ($this->serciveFiles->removeElement($serciveFile)) {
            // set the owning side to null (unless already changed)
            if ($serciveFile->getService() === $this) {
                $serciveFile->setService(null);
            }
        }

        return $this;
    }
}
