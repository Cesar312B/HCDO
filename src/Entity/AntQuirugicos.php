<?php

namespace App\Entity;

use App\Repository\AntQuirugicosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntQuirugicosRepository::class)
 */
class AntQuirugicos
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
    private $procedimiento;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tiempo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complicaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="antQuirugicos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ant_clinico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tratamiento;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="antQuirugicos")
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

    public function getProcedimiento(): ?string
    {
        return $this->procedimiento;
    }

    public function setProcedimiento(?string $procedimiento): self
    {
        $this->procedimiento = strtoupper($procedimiento);

        return $this;
    }

    public function getTiempo(): ?string
    {
        return $this->tiempo;
    }

    public function setTiempo(?string $tiempo): self
    {
        $this->tiempo= strtoupper($tiempo);

        return $this;
    }

    public function getComplicaciones(): ?string
    {
        return $this->complicaciones;
    }

    public function setComplicaciones(?string $complicaciones): self
    {
        $this->complicaciones = strtoupper($complicaciones);

        return $this;
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

    public function getAntClinico(): ?string
    {
        return $this->ant_clinico;
    }

    public function setAntClinico(?string $ant_clinico): self
    {
        $this->ant_clinico = strtoupper($ant_clinico) ;

        return $this;
    }

    public function getTratamiento(): ?string
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?string $tratamiento): self
    {
        $this->tratamiento = strtoupper($tratamiento);

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
