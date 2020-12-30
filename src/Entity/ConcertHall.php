<?php

namespace App\Entity;

use App\Repository\ConcertHallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertHallRepository::class)
 */
class ConcertHall
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $TotalPlaces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Presentation;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $City;

    /**
     * @ORM\OneToMany(targetEntity=Hall::class, mappedBy="concertHall")
     */
    private $Halls;

    public function __construct()
    {
        $this->Halls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getTotalPlaces(): ?int
    {
        return $this->TotalPlaces;
    }

    public function setTotalPlaces(int $TotalPlaces): self
    {
        $this->TotalPlaces = $TotalPlaces;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->Presentation;
    }

    public function setPresentation(string $Presentation): self
    {
        $this->Presentation = $Presentation;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    /**
     * @return Collection|Hall[]
     */
    public function getHalls(): Collection
    {
        return $this->Halls;
    }

    public function addHall(Hall $hall): self
    {
        if (!$this->Halls->contains($hall)) {
            $this->Halls[] = $hall;
            $hall->setConcertHall($this);
        }

        return $this;
    }

    public function removeHall(Hall $hall): self
    {
        if ($this->Halls->removeElement($hall)) {
            // set the owning side to null (unless already changed)
            if ($hall->getConcertHall() === $this) {
                $hall->setConcertHall(null);
            }
        }

        return $this;
    }
}
