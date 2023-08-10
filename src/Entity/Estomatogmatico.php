<?php

namespace App\Entity;

use App\Repository\EstomatogmaticoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstomatogmaticoRepository::class)
 */
class Estomatogmatico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $opciones = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="estomatogmaticos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consulta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpciones(): ?array
    {
        return $this->opciones;
    }

    public function setOpciones(array $opciones): self
    {
        $this->opciones = $opciones;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

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
