<?php

namespace App\Entity;

use App\Repository\GuestPointsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestPointsRepository::class)]
class GuestPoints
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Guest::class, mappedBy: 'id')]
    #[ORM\Column(nullable:false)]
    private ?Guest $guest_id = null;

    #[ORM\Column]
    private ?int $total_points = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPoints(): ?int
    {
        return $this->total_points;
    }

    public function setTotalPoints(int $total_points): static
    {
        $this->total_points = $total_points;

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


    
}
