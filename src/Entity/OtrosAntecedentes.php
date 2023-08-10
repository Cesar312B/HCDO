<?php

namespace App\Entity;

use App\Repository\OtrosAntecedentesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OtrosAntecedentesRepository::class)
 */
class OtrosAntecedentes
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
    private $alergias;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Range(
     *      max = "now"
     * )
     */
    private $fecha_vacuna;
 

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="otrosAntecedentes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\ManyToOne(targetEntity=Vacunas::class, inversedBy="otros_antecedentes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $vacunas;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $n_dosis;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="otrosAntecedentes")
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

    public function getAlergias(): ?string
    {
        return $this->alergias;
    }

    public function setAlergias(?string $alergias): self
    {
        $this->alergias = strtoupper($alergias);

        return $this;
    }


    public function getFechaVacuna(): ?\DateTimeInterface
    {
        return $this->fecha_vacuna;
    }

    public function setFechaVacuna(?\DateTimeInterface $fecha_vacuna): self
    {
        $this->fecha_vacuna = $fecha_vacuna;

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

    public function getVacunas(): ?Vacunas
    {
        return $this->vacunas;
    }

    public function setVacunas(?Vacunas $vacunas): self
    {
        $this->vacunas = $vacunas;

        return $this;
    }

    public function getNDosis(): ?int
    {
        return $this->n_dosis;
    }

    public function setNDosis(int $n_dosis): self
    {
        $this->n_dosis = $n_dosis;

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
