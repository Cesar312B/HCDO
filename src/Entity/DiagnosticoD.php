<?php

namespace App\Entity;

use App\Repository\DiagnosticoDRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiagnosticoDRepository::class)
 */
class DiagnosticoD
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lado;

    /**
     * @ORM\ManyToOne(targetEntity=Piezas::class, inversedBy="diagnosticoDs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pieza;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="diagnosticoDs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consulta;

    /**
     * @ORM\ManyToOne(targetEntity=CIE::class, inversedBy="diagnosticoDs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cie;

 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $simbologia;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $tratamiento;



    public function __construct()
    {
       
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLado(): ?string
    {
        return $this->lado;
    }

    public function setLado(string $lado): self
    {
        $this->lado = $lado;

        return $this;
    }

    public function getPieza(): ?Piezas
    {
        return $this->pieza;
    }

    public function setPieza(?Piezas $pieza): self
    {
        $this->pieza = $pieza;

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

    public function getCie(): ?CIE
    {
        return $this->cie;
    }

    public function setCie(?CIE $cie): self
    {
        $this->cie = $cie;

        return $this;
    }

   

    public function getSimbologia(): ?string
    {
        return $this->simbologia;
    }

    public function setSimbologia(string $simbologia): self
    {
        $this->simbologia = $simbologia;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getTratamiento(): ?string
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?string $tratamiento): self
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

  


}
