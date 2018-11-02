<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KqueUniteRepository")
 */
class KqueUnite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medicament", mappedBy="kqueUnite")
     */
    private $medicament;

    public function __construct()
    {
        $this->medicament = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Medicament[]
     */
    public function getMedicament(): Collection
    {
        return $this->medicament;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicament->contains($medicament)) {
            $this->medicament[] = $medicament;
            $medicament->setKqueUnite($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicament->contains($medicament)) {
            $this->medicament->removeElement($medicament);
            // set the owning side to null (unless already changed)
            if ($medicament->getKqueUnite() === $this) {
                $medicament->setKqueUnite(null);
            }
        }

        return $this;
    }
}
