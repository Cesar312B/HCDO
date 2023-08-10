<?php

namespace App\Entity;

use App\Repository\NutricionalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NutricionalRepository::class)
 */
class Nutricional
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
    private $descripcion_hab;



    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="nutricionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consulta;

    /**
     * @ORM\ManyToOne(targetEntity=SubtipoNutricional::class, inversedBy="nutricionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $suptipo_nutricional;

    public function getId(): ?int
    {
        return $this->id;
    }

  



    public function getDescripcionHab(): ?string
    {
        return $this->descripcion_hab;
    }

    public function setDescripcionHab(?string $descripcion_hab): self
    {
        $this->descripcion_hab = strtoupper($descripcion_hab);

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

    public function getSuptipoNutricional(): ?SubtipoNutricional
    {
        return $this->suptipo_nutricional;
    }

    public function setSuptipoNutricional(?SubtipoNutricional $suptipo_nutricional): self
    {
        $this->suptipo_nutricional = $suptipo_nutricional;

        return $this;
    }
}
