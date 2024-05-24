<?php

namespace App\Entity;

use App\Repository\RewardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RewardRepository::class)]
class Reward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $reward_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $points_required = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, Redemption>
     */
    #[ORM\OneToMany(targetEntity: Redemption::class, mappedBy: 'reward_id')]
    private Collection $redemption;

    public function __construct()
    {
        $this->redemption = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRewardName(): ?string
    {
        return $this->reward_name;
    }

    public function setRewardName(string $reward_name): static
    {
        $this->reward_name = $reward_name;

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

    public function getPointsRequired(): ?int
    {
        return $this->points_required;
    }

    public function setPointsRequired(int $points_required): static
    {
        $this->points_required = $points_required;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Redemption>
     */
    public function getRedemption(): Collection
    {
        return $this->redemption;
    }

    public function addRedemption(Redemption $redemption): static
    {
        if (!$this->redemption->contains($redemption)) {
            $this->redemption->add($redemption);
            $redemption->setRewardId($this);
        }

        return $this;
    }

    public function removeRedemption(Redemption $redemption): static
    {
        if ($this->redemption->removeElement($redemption)) {
            // set the owning side to null (unless already changed)
            if ($redemption->getRewardId() === $this) {
                $redemption->setRewardId(null);
            }
        }

        return $this;
    }
}
