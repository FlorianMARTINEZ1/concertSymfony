<?php

namespace App\Entity;

use App\Repository\ShowListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShowListRepository::class)
 * @ORM\Table(name="`showlist`")
 */
class ShowList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Band::class, inversedBy="shows")
     */
    private $Band;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $TourName;

    /**
     * @ORM\ManyToOne(targetEntity=Hall::class, inversedBy="shows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Hall;

    public function __construct()
    {
        $this->Band = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Band[]
     */
    public function getBand(): Collection
    {
        return $this->Band;
    }

    public function addBand(Band $band): self
    {
        if (!$this->Band->contains($band)) {
            $this->Band[] = $band;
        }

        return $this;
    }

    public function removeBand(Band $band): self
    {
        $this->Band->removeElement($band);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getTourName(): ?string
    {
        return $this->TourName;
    }

    public function setTourName(?string $TourName): self
    {
        $this->TourName = $TourName;

        return $this;
    }

    public function getHall(): ?Hall
    {
        return $this->Hall;
    }

    public function setHall(?Hall $Hall): self
    {
        $this->Hall = $Hall;

        return $this;
    }
}
