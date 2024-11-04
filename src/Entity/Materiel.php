<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_serie = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(length: 255)]
    private ?string $disponibilite = null;

    /**
     * @var Collection<int, PvAffectation>
     */
    #[ORM\OneToMany(targetEntity: PvAffectation::class, mappedBy: 'materiel')]
    private Collection $pv_affectation;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $valeur_materiel = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_acquisition = null;

    public function __construct()
    {
        $this->pv_affectation = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numero_serie;
    }

    public function setNumeroSerie(string $numero_serie): static
    {
        $this->numero_serie = $numero_serie;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, PvAffectation>
     */
    public function getPvAffectation(): Collection
    {
        return $this->pv_affectation;
    }

    public function addPvAffectation(PvAffectation $pvAffectation): static
    {
        if (!$this->pv_affectation->contains($pvAffectation)) {
            $this->pv_affectation->add($pvAffectation);
            $pvAffectation->setMateriel($this);
        }

        return $this;
    }

    public function removePvAffectation(PvAffectation $pvAffectation): static
    {
        if ($this->pv_affectation->removeElement($pvAffectation)) {
            // set the owning side to null (unless already changed)
            if ($pvAffectation->getMateriel() === $this) {
                $pvAffectation->setMateriel(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getValeurMateriel(): ?int
    {
        return $this->valeur_materiel;
    }

    public function setValeurMateriel(int $valeur_materiel): static
    {
        $this->valeur_materiel = $valeur_materiel;

        return $this;
    }

    public function getDateAcquisition(): ?\DateTimeImmutable
    {
        return $this->date_acquisition;
    }

    public function setDateAcquisition(\DateTimeImmutable $date_acquisition): static
    {
        $this->date_acquisition = $date_acquisition;

        return $this;
    }
}
