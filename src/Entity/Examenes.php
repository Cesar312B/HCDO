<?php

namespace App\Entity;

use App\Repository\ExamenesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamenesRepository::class)
 */
class Examenes
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
    private $nombre_examen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_examen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_examen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="examenes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consulta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreExamen(): ?string
    {
        return $this->nombre_examen;
    }

    public function setNombreExamen(?string $nombre_examen): self
    {
        $this->nombre_examen =  strtoupper($nombre_examen);

        return $this;
    }

    public function getFechaExamen(): ?\DateTimeInterface
    {
        return $this->fecha_examen;
    }

    public function setFechaExamen(?\DateTimeInterface $fecha_examen): self
    {
        $this->fecha_examen = $fecha_examen;

        return $this;
    }

    public function getResultadoExamen(): ?string
    {
        return $this->resultado_examen;
    }

    public function setResultadoExamen(?string $resultado_examen): self
    {
        $this->resultado_examen = strtoupper($resultado_examen);

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->Observaciones;
    }

    public function setObservaciones(?string $Observaciones): self
    {
        $this->Observaciones = strtoupper($Observaciones);

        return $this;
    }

    public function getConsulta(): ?Consulta
    {
        return $this->consulta;
    }

    public function setConsulta(?Consulta $consulta): self
    {
        $this->consulta = $consulta;

        return $this;
    }
}
