<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SerciveFilesRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SerciveFilesRepository::class)]
#[Vich\Uploadable]
class SerciveFiles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["service.index"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[Vich\UploadableField("service", "file", mimeType: "type")]
    private ?File $fileSrc = null;

    #[Groups(["service.index"])]
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $type = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'file')]
    private Collection $services;

    #[ORM\ManyToOne(inversedBy: 'serciveFiles')]
    private ?Service $service = null;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setFile($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getFile() === $this) {
                $service->setFile(null);
            }
        }

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of fileSrc
     */ 
    public function getFileSrc(): ?File
    {
        return $this->fileSrc;
    }

    /**
     * Set the value of fileSrc
     *
     * @return  self
     */ 
    public function setFileSrc(?File $fileSrc): static
    {
        $this->fileSrc = $fileSrc;

        return $this;
    }
}
