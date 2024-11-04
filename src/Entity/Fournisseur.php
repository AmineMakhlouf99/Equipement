<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $contact_principal = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $type_service = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    /**
     * @var Collection<int, PvAffectation>
     */
    #[ORM\OneToMany(targetEntity: PvAffectation::class, mappedBy: 'fournisseur')]
    private Collection $pvAffectations;

    public function __construct()
    {
        $this->pvAffectations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(string $nom_entreprise): static
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
    }

    public function getContactPrincipal(): ?string
    {
        return $this->contact_principal;
    }

    public function setContactPrincipal(string $contact_principal): static
    {
        $this->contact_principal = $contact_principal;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTypeService(): ?string
    {
        return $this->type_service;
    }

    public function setTypeService(string $type_service): static
    {
        $this->type_service = $type_service;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, PvAffectation>
     */
    public function getPvAffectations(): Collection
    {
        return $this->pvAffectations;
    }

    public function addPvAffectation(PvAffectation $pvAffectation): static
    {
        if (!$this->pvAffectations->contains($pvAffectation)) {
            $this->pvAffectations->add($pvAffectation);
            $pvAffectation->setFournisseur($this);
        }

        return $this;
    }

    public function removePvAffectation(PvAffectation $pvAffectation): static
    {
        if ($this->pvAffectations->removeElement($pvAffectation)) {
            // set the owning side to null (unless already changed)
            if ($pvAffectation->getFournisseur() === $this) {
                $pvAffectation->setFournisseur(null);
            }
        }

        return $this;
    }
}
