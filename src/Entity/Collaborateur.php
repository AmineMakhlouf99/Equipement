<?php

namespace App\Entity;

use App\Repository\CollaborateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollaborateurRepository::class)]
class Collaborateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

    #[ORM\Column(length: 255)]
    private ?string $departement = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_embauche = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var Collection<int, PvAffectation>
     */
    #[ORM\OneToMany(targetEntity: PvAffectation::class, mappedBy: 'collaborateur')]
    private Collection $pvAffectations;

    public function __construct()
    {
        $this->pvAffectations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): static
    {
        $this->departement = $departement;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeImmutable
    {
        return $this->date_embauche;
    }

    public function setDateEmbauche(\DateTimeImmutable $date_embauche): static
    {
        $this->date_embauche = $date_embauche;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
            $pvAffectation->setCollaborateur($this);
        }

        return $this;
    }

    public function removePvAffectation(PvAffectation $pvAffectation): static
    {
        if ($this->pvAffectations->removeElement($pvAffectation)) {
            // set the owning side to null (unless already changed)
            if ($pvAffectation->getCollaborateur() === $this) {
                $pvAffectation->setCollaborateur(null);
            }
        }

        return $this;
    }
}
