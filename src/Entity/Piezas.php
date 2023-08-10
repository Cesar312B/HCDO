<?php

namespace App\Entity;

use App\Repository\PiezasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PiezasRepository::class)
 */
class Piezas
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity=DiagnosticoD::class, mappedBy="pieza", orphanRemoval=true)
     */
    private $diagnosticoDs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edad;

    public function __construct()
    {
        $this->diagnosticoDs = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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
     * @return Collection<int, DiagnosticoD>
     */
    public function getDiagnosticoDs(): Collection
    {
        return $this->diagnosticoDs;
    }

    public function addDiagnosticoD(DiagnosticoD $diagnosticoD): self
    {
        if (!$this->diagnosticoDs->contains($diagnosticoD)) {
            $this->diagnosticoDs[] = $diagnosticoD;
            $diagnosticoD->setPieza($this);
        }

        return $this;
    }

    public function removeDiagnosticoD(DiagnosticoD $diagnosticoD): self
    {
        if ($this->diagnosticoDs->removeElement($diagnosticoD)) {
            // set the owning side to null (unless already changed)
            if ($diagnosticoD->getPieza() === $this) {
                $diagnosticoD->setPieza(null);
            }
        }

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(string $edad): self
    {
        $this->edad = $edad;

        return $this;
    }


}
