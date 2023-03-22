<?php

namespace App\Entity;

use App\Repository\TrackDiffucltyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackDiffucltyRepository::class)]
class TrackDiffuclty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'difficulty', targetEntity: Tracks::class)]
    private Collection $tracks;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
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
            $track->setDifficulty($this);
        }

        return $this;
    }

    public function removeTrack(Tracks $track): self
    {
        if ($this->tracks->removeElement($track)) {
            // set the owning side to null (unless already changed)
            if ($track->getDifficulty() === $this) {
                $track->setDifficulty(null);
            }
        }

        return $this;
    }
}
