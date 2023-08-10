<?php

namespace App\Entity;

use App\Repository\TratamientoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TratamientoRepository::class)
 */
class Tratamiento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dosis;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $frecuencia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duracion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $indicaciones;

   

    /**
     * @ORM\ManyToOne(targetEntity=Diagnostico::class, inversedBy="tratamiento")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diagnostico;

    /**
     * @ORM\ManyToOne(targetEntity=Medicamentos::class, inversedBy="tratamientos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $medicamentos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $presentacion;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDosis(): ?string
    {
        return $this->dosis;
    }

    public function setDosis(?string $dosis): self
    {
        $this->dosis = strtoupper($dosis);

        return $this;
    }

    public function getFrecuencia(): ?string
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(?string $frecuencia): self
    {
        $this->frecuencia = strtoupper($frecuencia);

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(?string $duracion): self
    {
        $this->duracion = strtoupper($duracion);

        return $this;
    }

    public function getIndicaciones(): ?string
    {
        return $this->indicaciones;
    }

    public function setIndicaciones(?string $indicaciones): self
    {
        $this->indicaciones = $indicaciones;

        return $this;
    }

   
    public function getDiagnostico(): ?Diagnostico
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(Diagnostico $diagnostico): self
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    public function getMedicamentos(): ?Medicamentos
    {
        return $this->medicamentos;
    }

    public function setMedicamentos(?Medicamentos $medicamentos): self
    {
        $this->medicamentos = $medicamentos;

        return $this;
    }

    public function getPresentacion(): ?string
    {
        return $this->presentacion;
    }

    public function setPresentacion(?string $presentacion): self
    {
        $this->presentacion = $presentacion;

        return $this;
    }

}
