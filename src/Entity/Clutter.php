<?php

namespace App\Entity;

use App\Repository\ClutterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClutterRepository::class)]
class Clutter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'clutter', targetEntity: Tracks::class)]
    private Collection $tracks;

    #[ORM\OneToMany(mappedBy: 'clutter', targetEntity: Lifts::class)]
    private Collection $lifts;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->lifts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Tracks>
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Tracks $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks->add($track);
            $track->setClutter($this);
        }

        return $this;
    }

    public function removeTrack(Tracks $track): self
    {
        if ($this->tracks->removeElement($track)) {
            // set the owning side to null (unless already changed)
            if ($track->getClutter() === $this) {
                $track->setClutter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lifts>
     */
    public function getLifts(): Collection
    {
        return $this->lifts;
    }

    public function addLift(Lifts $lift): self
    {
        if (!$this->lifts->contains($lift)) {
            $this->lifts->add($lift);
            $lift->setClutter($this);
        }

        return $this;
    }

    public function removeLift(Lifts $lift): self
    {
        if ($this->lifts->removeElement($lift)) {
            // set the owning side to null (unless already changed)
            if ($lift->getClutter() === $this) {
                $lift->setClutter(null);
            }
        }

        return $this;
    }
}
