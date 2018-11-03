<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PathologieRepository")
 */
class Pathologie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medicament", mappedBy="pathologie")
     */
    private $medicament;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Astuces", mappedBy="pathologie")
     */
    private $astuces;

    public function __construct()
    {
        $this->medicament = new ArrayCollection();
        $this->astuces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
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
            $medicament->setPathologie($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicament->contains($medicament)) {
            $this->medicament->removeElement($medicament);
            // set the owning side to null (unless already changed)
            if ($medicament->getPathologie() === $this) {
                $medicament->setPathologie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Astuces[]
     */
    public function getAstuces(): Collection
    {
        return $this->astuces;
    }

    public function addAstuce(Astuces $astuce): self
    {
        if (!$this->astuces->contains($astuce)) {
            $this->astuces[] = $astuce;
            $astuce->setPathologie($this);
        }

        return $this;
    }

    public function removeAstuce(Astuces $astuce): self
    {
        if ($this->astuces->contains($astuce)) {
            $this->astuces->removeElement($astuce);
            // set the owning side to null (unless already changed)
            if ($astuce->getPathologie() === $this) {
                $astuce->setPathologie(null);
            }
        }

        return $this;
    }
}
