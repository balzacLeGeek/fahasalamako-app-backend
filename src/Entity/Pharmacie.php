<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PharmacieRepository")
 */
class Pharmacie
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
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $telephone;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produits", mappedBy="pharmacie")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TourGarde", mappedBy="pharmacie")
     */
    private $tourGardes;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->tourGardes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setPharmacie($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getPharmacie() === $this) {
                $produit->setPharmacie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TourGarde[]
     */
    public function getTourGardes(): Collection
    {
        return $this->tourGardes;
    }

    public function addTourGarde(TourGarde $tourGarde): self
    {
        if (!$this->tourGardes->contains($tourGarde)) {
            $this->tourGardes[] = $tourGarde;
            $tourGarde->setPharmacie($this);
        }

        return $this;
    }

    public function removeTourGarde(TourGarde $tourGarde): self
    {
        if ($this->tourGardes->contains($tourGarde)) {
            $this->tourGardes->removeElement($tourGarde);
            // set the owning side to null (unless already changed)
            if ($tourGarde->getPharmacie() === $this) {
                $tourGarde->setPharmacie(null);
            }
        }

        return $this;
    }
}
