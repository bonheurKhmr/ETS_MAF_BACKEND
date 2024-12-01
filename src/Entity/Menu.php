<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column]
    private ?bool $is_activated = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, SousMenu>
     */
    #[ORM\OneToMany(targetEntity: SousMenu::class, mappedBy: 'menu')]
    private Collection $sousMenus;

    #[ORM\Column]
    private ?int $orders = null;

    #[ORM\ManyToOne(inversedBy: 'menus')]
    private ?MenuType $type = null;

    public function __construct()
    {
        $this->sousMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

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

    /**
     * @return Collection<int, SousMenu>
     */
    public function getSousMenus(): Collection
    {
        return $this->sousMenus;
    }

    public function addSousMenu(SousMenu $sousMenu): static
    {
        if (!$this->sousMenus->contains($sousMenu)) {
            $this->sousMenus->add($sousMenu);
            $sousMenu->setMenu($this);
        }

        return $this;
    }

    public function removeSousMenu(SousMenu $sousMenu): static
    {
        if ($this->sousMenus->removeElement($sousMenu)) {
            // set the owning side to null (unless already changed)
            if ($sousMenu->getMenu() === $this) {
                $sousMenu->setMenu(null);
            }
        }

        return $this;
    }

    public function getOrders(): ?int
    {
        return $this->orders;
    }

    public function setOrders(int $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getType(): ?MenuType
    {
        return $this->type;
    }

    public function setType(?MenuType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
