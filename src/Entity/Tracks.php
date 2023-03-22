<?php

namespace App\Entity;

use App\Repository\TracksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TracksRepository::class)]
class Tracks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $opening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closure = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    private ?TrackDiffuclty $difficulty = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    private ?Level $level = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    private ?Material $material = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
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

    public function getClosure(): ?\DateTimeInterface
    {
        return $this->closure;
    }

    public function setClosure(\DateTimeInterface $closure): self
    {
        $this->closure = $closure;

        return $this;
    }

    public function getDifficulty(): ?TrackDiffuclty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?TrackDiffuclty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->material = $material;

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
}
