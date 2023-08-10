<?php

namespace App\Entity;

use App\Repository\AntLaboralesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntLaboralesRepository::class)
 */
class AntLaborales
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="antLaborales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $puesto_trabajo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $actividades;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tiempo_trabajo;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $riesgo = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ac_trabajo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enferemedad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ob_enfermedades;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $act_extra;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion_accidentes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion_emfermedad;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_accidente;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_enfermedad;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="antLaborales")
     * @ORM\JoinColumn(nullable=true)
     */
    private $consulta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creatdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedate;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPacientes(): ?Pacientes
    {
        return $this->pacientes;
    }

    public function setPacientes(?Pacientes $pacientes): self
    {
        $this->pacientes = $pacientes;

        return $this;
    }

    public function getEmpresa(): ?string
    {
        return $this-> empresa;
    }

    public function setEmpresa(?string $empresa): self
    {
        $this->empresa = strtoupper ($empresa);

        return $this;
    }

    public function getPuestoTrabajo(): ?string
    {
        return $this->puesto_trabajo;
    }

    public function setPuestoTrabajo(?string $puesto_trabajo): self
    {
        $this->puesto_trabajo = strtoupper($puesto_trabajo) ;

        return $this;
    }

    public function getActividades(): ?string
    {
        return $this->actividades;
    }

    public function setActividades(?string $actividades): self
    {
        $this->actividades = strtoupper($actividades) ;

        return $this;
    }

    public function getTiempoTrabajo(): ?float
    {
        return $this->tiempo_trabajo;
    }

    public function setTiempoTrabajo(?float $tiempo_trabajo): self
    {
        $this->tiempo_trabajo = $tiempo_trabajo;

        return $this;
    }

    public function getRiesgo(): ?array
    {
        $riesgo= $this->riesgo;
        return array($riesgo);

    }

    public function setRiesgo(?array $riesgo): self
    {
        $this->riesgo = $riesgo;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = strtoupper($observaciones)  ;

        return $this;
    }

    public function getAcTrabajo(): ?string
    {
        return $this->ac_trabajo;
    }

    public function setAcTrabajo(?string $ac_trabajo): self
    {
        $this->ac_trabajo = strtoupper ($ac_trabajo);

        return $this;
    }

    public function getEnferemedad(): ?string
    {
        return $this->enferemedad;
    }

    public function setEnferemedad(?string $enferemedad): self
    {
        $this->enferemedad = strtoupper ($enferemedad);

        return $this;
    }

    public function getObEnfermedades(): ?string
    {
        return $this->ob_enfermedades;
    }

    public function setObEnfermedades(?string $ob_enfermedades): self
    {
        $this->ob_enfermedades = strtoupper ($ob_enfermedades);

        return $this;
    }

    public function getActExtra(): ?string
    {
        return $this->act_extra;
    }

    public function setActExtra(?string $act_extra): self
    {
        $this->act_extra = strtoupper ($act_extra);

        return $this;
    }

    public function getDescripcionAccidentes(): ?string
    {
        return $this->descripcion_accidentes;
    }

    public function setDescripcionAccidentes(?string $descripcion_accidentes): self
    {
        $this->descripcion_accidentes = strtoupper($descripcion_accidentes);

        return $this;
    }

    public function getDescripcionEmfermedad(): ?string
    {
        return $this->descripcion_emfermedad;
    }

    public function setDescripcionEmfermedad(?string $descripcion_emfermedad): self
    {
        $this->descripcion_emfermedad = strtoupper ($descripcion_emfermedad);

        return $this;
    }

    public function getFechaAccidente(): ?\DateTimeInterface
    {
        return $this->fecha_accidente;
    }

    public function setFechaAccidente(?\DateTimeInterface $fecha_accidente): self
    {
        $this->fecha_accidente = $fecha_accidente;

        return $this;
    }

    public function getFechaEnfermedad(): ?\DateTimeInterface
    {
        return $this->fecha_enfermedad;
    }

    public function setFechaEnfermedad(?\DateTimeInterface $fecha_enfermedad): self
    {
        $this->fecha_enfermedad = $fecha_enfermedad;

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

    public function getCreatdate(): ?\DateTimeInterface
    {
        return $this->creatdate;
    }

    public function setCreatdate(?\DateTimeInterface $creatdate): self
    {
        $this->creatdate = $creatdate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(?\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    
}
