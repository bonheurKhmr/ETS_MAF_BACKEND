<?php

namespace App\Entity;

use App\Repository\SousMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SousMenuRepository::class)]
class SousMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["sous_menu.index"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["sous_menu.index"])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["sous_menu.index"])]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?bool $is_activated = null;

    #[ORM\ManyToOne(inversedBy: 'sousMenus')]
    private ?Menu $menu = null;

    /**
     * @var Collection<int, SousMenuImages>
     */
    #[Groups(["sous_menu.index"])]
    #[ORM\OneToMany(targetEntity: SousMenuImages::class, mappedBy: 'sous_menu', cascade: ['persist'])]
    private Collection $sousMenuImages;

    #[ORM\Column(length: 10)]
    private ?string $direction = null;

    #[ORM\Column]
    #[Groups(["sous_menu.index"])]
    private ?bool $see_more = null;

    #[ORM\Column]
    private ?int $orders = null;

    #[Groups(["sous_menu.index"])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Icon = null;

    public function __construct()
    {
        $this->sousMenuImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): static
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return Collection<int, SousMenuImages>
     */
    public function getSousMenuImages(): Collection
    {
        return $this->sousMenuImages;
    }

    public function addSousMenuImage(SousMenuImages $sousMenuImage): static
    {
        if (!$this->sousMenuImages->contains($sousMenuImage)) {
            $this->sousMenuImages->add($sousMenuImage);
            $sousMenuImage->setSousMenu($this);
        }

        return $this;
    }

    public function removeSousMenuImage(SousMenuImages $sousMenuImage): static
    {
        if ($this->sousMenuImages->removeElement($sousMenuImage)) {
            // set the owning side to null (unless already changed)
            if ($sousMenuImage->getSousMenu() === $this) {
                $sousMenuImage->setSousMenu(null);
            }
        }

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function isSeeMore(): ?bool
    {
        return $this->see_more;
    }

    public function setSeeMore(bool $see_more): static
    {
        $this->see_more = $see_more;

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

    public function getIcon(): ?string
    {
        return $this->Icon;
    }

    public function setIcon(?string $Icon): static
    {
        $this->Icon = $Icon;

        return $this;
    }
}
