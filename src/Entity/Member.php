<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
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
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Job;

    /**
     * @ORM\Column(type="date")
     */
    private $BirthDate;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Picture;

    /**
     * @ORM\ManyToOne(targetEntity=Band::class, inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Band;

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

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->Job;
    }

    public function setJob(string $Job): self
    {
        $this->Job = $Job;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

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

    public function getBand(): ?Band
    {
        return $this->Band;
    }

    public function setBand(?Band $Band): self
    {
        $this->Band = $Band;

        return $this;
    }
}
