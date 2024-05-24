<?php

namespace App\Entity;

use App\Repository\RedemptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RedemptionRepository::class)]
class Redemption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Guest::class)]
    #[ORM\JoinColumn(nullable: true, name: 'guest_id', referencedColumnName: 'id')]
    private ?Guest $guest_id = null;

    #[ORM\ManyToOne(targetEntity: Reward::class)]
    #[ORM\JoinColumn(nullable: true, name: 'reward_id', referencedColumnName: 'id')]
    private ?Reward $reward_id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $redemption_date = null;

    #[ORM\Column]
    private ?int $points_redeemed = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRedemptionDate(): ?\DateTimeImmutable
    {
        return $this->redemption_date;
    }

    public function setRedemptionDate(\DateTimeImmutable $redemption_date): static
    {
        $this->redemption_date = $redemption_date;

        return $this;
    }

    public function getPointsRedeemed(): ?int
    {
        return $this->points_redeemed;
    }

    public function setPointsRedeemed(int $points_redeemed): static
    {
        $this->points_redeemed = $points_redeemed;

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

    public function getGuestId(): ?Guest
    {
        return $this->guest_id;
    }

    public function setGuestId(?Guest $guest_id): static
    {
        $this->guest_id = $guest_id;

        return $this;
    }

    public function getRewardId(): ?Reward
    {
        return $this->reward_id;
    }

    public function setRewardId(?Reward $reward_id): static
    {
        $this->reward_id = $reward_id;

        return $this;
    }

    public function __toString(): string {
        return $this->guest_id;
    }
}
