<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BandRepository::class)
 */
class Band
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
     * @ORM\Column(type="string", length=25)
     */
    private $Style;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="bands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Picture;

    /**
     * @ORM\Column(type="date")
     */
    private $YearOfCreation;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $LastAlbumName;

    /**
     * @ORM\ManyToMany(targetEntity=ShowList::class, mappedBy="Band")
     */
    private $shows;

    /**
     * @ORM\OneToMany(targetEntity=Member::class, mappedBy="Band")
     */
    private $members;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
        $this->members = new ArrayCollection();
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

    public function getStyle(): ?string
    {
        return $this->Style;
    }

    public function setStyle(string $Style): self
    {
        $this->Style = $Style;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->Picture;
    }

    public function setPicture(?Picture $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getYearOfCreation(): ?\DateTimeInterface
    {
        return $this->YearOfCreation;
    }

    public function setYearOfCreation(\DateTimeInterface $YearOfCreation): self
    {
        $this->YearOfCreation = $YearOfCreation;

        return $this;
    }

    public function getLastAlbumName(): ?string
    {
        return $this->LastAlbumName;
    }

    public function setLastAlbumName(string $LastAlbumName): self
    {
        $this->LastAlbumName = $LastAlbumName;

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
            $show->addBand($this);
        }

        return $this;
    }

    public function removeShow(ShowList $show): self
    {
        if ($this->shows->removeElement($show)) {
            $show->removeBand($this);
        }

        return $this;
    }

    /**
     * @return Collection|Member[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setBand($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getBand() === $this) {
                $member->setBand(null);
            }
        }

        return $this;
    }
}
