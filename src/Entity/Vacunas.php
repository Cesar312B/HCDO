<?php

namespace App\Entity;

use App\Repository\VacunasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacunasRepository::class)
 */
class Vacunas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $Dosis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Indicaciones;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity=OtrosAntecedentes::class, mappedBy="vacunas", orphanRemoval=true)
     */
    private $otros_antecedentes;

    public function __construct()
    {
        $this->otros_antecedentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDosis(): ?int
    {
        return $this->Dosis;
    }

    public function setDosis(int $Dosis): self
    {
        $this->Dosis = $Dosis;

        return $this;
    }

    public function getIndicaciones(): ?string
    {
        return $this->Indicaciones;
    }

    public function setIndicaciones(string $Indicaciones): self
    {
        $this->Indicaciones = $Indicaciones;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection|OtrosAntecedentes[]
     */
    public function getOtrosAntecedentes(): Collection
    {
        return $this->otros_antecedentes;
    }

    public function addOtrosAntecedente(OtrosAntecedentes $otrosAntecedente): self
    {
        if (!$this->otros_antecedentes->contains($otrosAntecedente)) {
            $this->otros_antecedentes[] = $otrosAntecedente;
            $otrosAntecedente->setVacunas($this);
        }

        return $this;
    }

    public function removeOtrosAntecedente(OtrosAntecedentes $otrosAntecedente): self
    {
        if ($this->otros_antecedentes->removeElement($otrosAntecedente)) {
            // set the owning side to null (unless already changed)
            if ($otrosAntecedente->getVacunas() === $this) {
                $otrosAntecedente->setVacunas(null);
            }
        }

        return $this;
    }
}
