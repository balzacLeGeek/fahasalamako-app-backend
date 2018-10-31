<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LaboratoryRepository")
 */
class Laboratory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $siteweb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $BP;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medicament", mappedBy="laboratory")
     */
    private $medicament;

    public function __construct()
    {
        $this->medicament = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function __toString(): ?string 
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getFax(): ?int
    {
        return $this->fax;
    }

    public function setFax(?int $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getBP(): ?string
    {
        return $this->BP;
    }

    public function setBP(?string $BP): self
    {
        $this->BP = $BP;

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
            $medicament->setLaboratory($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicament->contains($medicament)) {
            $this->medicament->removeElement($medicament);
            // set the owning side to null (unless already changed)
            if ($medicament->getLaboratory() === $this) {
                $medicament->setLaboratory(null);
            }
        }

        return $this;
    }
}
