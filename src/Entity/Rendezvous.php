<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RendezvousRepository")
 */
class Rendezvous
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Docteur", inversedBy="rendezvouses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Docteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponible;

    public function __construct()
    {
        $this->disponible = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocteur(): ?Docteur
    {
        return $this->Docteur;
    }

    public function setDocteur(?Docteur $Docteur): self
    {
        $this->Docteur = $Docteur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDisponibile(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponibile(bool $disponible): self
    {
        $this->ouvert = $disponible;

        return $this;
    }
}
