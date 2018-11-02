<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialiteRepository")
 */
class Specialite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Docteur", mappedBy="specialite")
     */
    private $docteurs;

    public function __construct()
    {
        $this->docteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Docteur[]
     */
    public function getDocteurs(): Collection
    {
        return $this->docteurs;
    }

    public function addDocteur(Docteur $docteur): self
    {
        if (!$this->docteurs->contains($docteur)) {
            $this->docteurs[] = $docteur;
            $docteur->setSpecialite($this);
        }

        return $this;
    }

    public function removeDocteur(Docteur $docteur): self
    {
        if ($this->docteurs->contains($docteur)) {
            $this->docteurs->removeElement($docteur);
            // set the owning side to null (unless already changed)
            if ($docteur->getSpecialite() === $this) {
                $docteur->setSpecialite(null);
            }
        }

        return $this;
    }
}
