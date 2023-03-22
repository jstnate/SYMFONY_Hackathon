<?php

namespace App\Entity;

use App\Repository\LiftRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiftRepository::class)]
class Lift
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
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?Clutter $clutter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(nullable: true)]
    private ?bool $forcedClosure = null;

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?Station $station = null;

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

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
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

    public function setMessage(?string $message): self
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

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }
}
