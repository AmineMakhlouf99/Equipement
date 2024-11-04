<?php

namespace App\Entity;

use App\Repository\PvAffectationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PvAffectationRepository::class)]
class PvAffectation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pvAffectations')]
    #[ORM\JoinColumn(nullable: true)]    
    private ?Collaborateur $collaborateur = null;

    #[ORM\ManyToOne(inversedBy: 'pvAffectations')]
    #[ORM\JoinColumn(nullable: true)]    
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'pvAffectations')]
    #[ORM\JoinColumn(nullable: true)]    
    private ?Materiel $materiel = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_debut_affectation = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date_fin_affectation = null;
    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date_retour = null;
    #[ORM\Column(type: Types::TEXT)]
    private ?string $motif_affectation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollaborateur(): ?Collaborateur
    {
        return $this->collaborateur;
    }

    public function setCollaborateur(?Collaborateur $collaborateur): static
    {
        $this->collaborateur = $collaborateur;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): static
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getDateDebutAffectation(): ?\DateTimeImmutable
    {
        return $this->date_debut_affectation;
    }

    public function setDateDebutAffectation(\DateTimeImmutable $date_debut_affectation): static
    {
        $this->date_debut_affectation = $date_debut_affectation;

        return $this;
    }

    public function getDateFinAffectation(): ?\DateTimeImmutable
    {
        return $this->date_fin_affectation;
    }

    public function setDateFinAffectation(\DateTimeImmutable $date_fin_affectation): static
    {
        $this->date_fin_affectation = $date_fin_affectation;

        return $this;
    }
    public function getDateRetour(): ?\DateTimeImmutable
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTimeImmutable $date_retour): static
    {
        $this->date_retour = $date_retour;

        return $this;
    }    
    
    public function getMotifAffectation(): ?string
    {
        return $this->motif_affectation;
    }

    public function setMotifAffectation(string $motif_affectation): static
    {
        $this->motif_affectation = $motif_affectation;

        return $this;
    }
}
