<?php

namespace App\Entity;

use App\Repository\ActividadesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActividadesRepository::class)
 */
class Actividades
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $actividad;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $riesgos = [];

    /**
     * @ORM\ManyToOne(targetEntity=PuestoTrabajo::class, inversedBy="actividades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $puesto_trabajo;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActividad(): ?string
    {
        return $this->actividad;
    }

    public function setActividad(string $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }

    public function getRiesgos(): ?array
    {
        $riesgos= $this->riesgos;
        return array_unique($riesgos);
    }

    public function setRiesgos(?array $riesgos): self
    {
        $this->riesgos = $riesgos;

        return $this;
    }

    public function getPuestoTrabajo(): ?PuestoTrabajo
    {
        return $this->puesto_trabajo;
    }

    public function setPuestoTrabajo(?PuestoTrabajo $puesto_trabajo): self
    {
        $this->puesto_trabajo = $puesto_trabajo;

        return $this;
    }

  
}
