<?php

namespace App\Entity;

use App\Repository\LiftTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiftTypeRepository::class)]
class LiftType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Lifts::class)]
    private Collection $lifts;

    public function __construct()
    {
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
            $lift->setType($this);
        }

        return $this;
    }

    public function removeLift(Lifts $lift): self
    {
        if ($this->lifts->removeElement($lift)) {
            // set the owning side to null (unless already changed)
            if ($lift->getType() === $this) {
                $lift->setType(null);
            }
        }

        return $this;
    }
}
