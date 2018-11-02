<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 */
class Medicament
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
    private $infoGenerale;

    /**
     * @ORM\Column(type="float")
     */
    private $kqueQuantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\KqueUnite", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kqueUnite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodeATC", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codeATC;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aspectForme;

    /**
     * @ORM\Column(type="text")
     */
    private $casUtilisation;

    /**
     * @ORM\Column(type="text")
     */
    private $Posologie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $effet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contreIndication;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PrincipesActifs", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $principesActifs;

    /**
     * @ORM\Column(type="text")
     */
    private $expicients;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Laboratoire", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laboratoire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pathologie", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pathologie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produits", mappedBy="medicament")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
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

    public function getInfoGenerale(): ?string
    {
        return $this->infoGenerale;
    }

    public function setInfoGenerale(string $infoGenerale): self
    {
        $this->infoGenerale = $infoGenerale;

        return $this;
    }

    public function getKqueQuantite(): ?float
    {
        return $this->kqueQuantite;
    }

    public function setKqueQuantite(float $kqueQuantite): self
    {
        $this->kqueQuantite = $kqueQuantite;

        return $this;
    }

    public function getKqueUnite(): ?KqueUnite
    {
        return $this->kqueUnite;
    }

    public function setKqueUnite(?KqueUnite $kqueUnite): self
    {
        $this->kqueUnite = $kqueUnite;

        return $this;
    }

    public function getCodeATC(): ?CodeATC
    {
        return $this->codeATC;
    }

    public function setCodeATC(?CodeATC $codeATC): self
    {
        $this->codeATC = $codeATC;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getAspectForme(): ?string
    {
        return $this->aspectForme;
    }

    public function setAspectForme(string $aspectForme): self
    {
        $this->aspectForme = $aspectForme;

        return $this;
    }

    public function getCasUtilisation(): ?string
    {
        return $this->casUtilisation;
    }

    public function setCasUtilisation(string $casUtilisation): self
    {
        $this->casUtilisation = $casUtilisation;

        return $this;
    }

    public function getPosologie(): ?string
    {
        return $this->Posologie;
    }

    public function setPosologie(string $Posologie): self
    {
        $this->Posologie = $Posologie;

        return $this;
    }

    public function getEffet(): ?string
    {
        return $this->effet;
    }

    public function setEffet(?string $effet): self
    {
        $this->effet = $effet;

        return $this;
    }

    public function getContreIndication(): ?string
    {
        return $this->contreIndication;
    }

    public function setContreIndication(?string $contreIndication): self
    {
        $this->contreIndication = $contreIndication;

        return $this;
    }

    public function getPrincipesActifs(): ?PrincipesActifs
    {
        return $this->principesActifs;
    }

    public function setPrincipesActifs(?PrincipesActifs $principesActifs): self
    {
        $this->principesActifs = $principesActifs;

        return $this;
    }

    public function getExpicients(): ?string
    {
        return $this->expicients;
    }

    public function setExpicients(string $expicients): self
    {
        $this->expicients = $expicients;

        return $this;
    }

    public function getLaboratoire(): ?Laboratoire
    {
        return $this->laboratoire;
    }

    public function setLaboratoire(?Laboratoire $laboratoire): self
    {
        $this->laboratoire = $laboratoire;

        return $this;
    }

    public function getPathologie(): ?Pathologie
    {
        return $this->pathologie;
    }

    public function setPathologie(?Pathologie $pathologie): self
    {
        $this->pathologie = $pathologie;

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
            $produit->setMedicament($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getMedicament() === $this) {
                $produit->setMedicament(null);
            }
        }

        return $this;
    }
}
