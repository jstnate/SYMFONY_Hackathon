<?php

namespace App\Entity;

use App\Repository\LiftsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiftsRepository::class)]
class Lifts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $opening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closing = null;

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?LiftType $type = null;

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?Clutter $clutter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(nullable: true)]
    private ?bool $forcedClosure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpening(): ?\DateTimeInterface
    {
        return $this->opening;
    }

    public function setOpening(\DateTimeInterface $opening): self
    {
        $this->opening = $opening;

        return $this;
    }

    public function getClosing(): ?\DateTimeInterface
    {
        return $this->closing;
    }

    public function setClosing(\DateTimeInterface $closing): self
    {
        $this->closing = $closing;

        return $this;
    }

    public function getType(): ?LiftType
    {
        return $this->type;
    }

    public function setType(?LiftType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getClutter(): ?Clutter
    {
        return $this->clutter;
    }

    public function setClutter(?Clutter $clutter): self
    {
        $this->clutter = $clutter;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isForcedClosure(): ?bool
    {
        return $this->forcedClosure;
    }

    public function setForcedClosure(?bool $forcedClosure): self
    {
        $this->forcedClosure = $forcedClosure;

        return $this;
    }
}
