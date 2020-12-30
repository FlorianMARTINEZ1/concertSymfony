<?php

namespace App\Entity;

use App\Repository\HallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HallRepository::class)
 */
class Hall
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
    private $Capacity;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Available;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertHall::class, inversedBy="Halls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concertHall;

    /**
     * @ORM\OneToMany(targetEntity=ShowList::class, mappedBy="Hall")
     */
    private $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
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

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(int $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function getAvailable(): ?string
    {
        return $this->Available;
    }

    public function setAvailable(string $Available): self
    {
        $this->Available = $Available;

        return $this;
    }

    public function getConcertHall(): ?ConcertHall
    {
        return $this->concertHall;
    }

    public function setConcertHall(?ConcertHall $concertHall): self
    {
        $this->concertHall = $concertHall;

        return $this;
    }

    /**
     * @return Collection|ShowList[]
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(ShowList $show): self
    {
        if (!$this->shows->contains($show)) {
            $this->shows[] = $show;
            $show->setHall($this);
        }

        return $this;
    }

    public function removeShow(ShowList $show): self
    {
        if ($this->shows->removeElement($show)) {
            // set the owning side to null (unless already changed)
            if ($show->getHall() === $this) {
                $show->setHall(null);
            }
        }

        return $this;
    }
    
}
