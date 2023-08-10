<?php

namespace App\Entity;

use App\Repository\PuestoTrabajoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PuestoTrabajoRepository::class)
 */
class PuestoTrabajo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nombre;


    /**
     * @ORM\Column(type="string", length=1200)
     */
    private $medidas_preventivas;

    /**
     * @ORM\OneToMany(targetEntity=Actividades::class, mappedBy="puesto_trabajo", orphanRemoval=true)
     */
    private $actividades;

    /**
     * @ORM\OneToMany(targetEntity=Pacientes::class, mappedBy="puesto_trabajo", orphanRemoval=true)
     */
    private $pacientes;

    
    public function __construct()
    {
        $this->actividades = new ArrayCollection();
        $this->pacientes = new ArrayCollection();
       
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getMedidasPreventivas(): ?string
    {
        return $this->medidas_preventivas;
    }

    public function setMedidasPreventivas(string $medidas_preventivas): self
    {
        $this->medidas_preventivas = $medidas_preventivas;

        return $this;
    }

    /**
     * @return Collection|Actividades[]
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividades $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->setPuestoTrabajo($this);
        }

        return $this;
    }

    public function removeActividade(Actividades $actividade): self
    {
        if ($this->actividades->removeElement($actividade)) {
            // set the owning side to null (unless already changed)
            if ($actividade->getPuestoTrabajo() === $this) {
                $actividade->setPuestoTrabajo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pacientes[]
     */
    public function getPacientes(): Collection
    {
        return $this->pacientes;
    }

    public function addPaciente(Pacientes $paciente): self
    {
        if (!$this->pacientes->contains($paciente)) {
            $this->pacientes[] = $paciente;
            $paciente->setPuestoTrabajo($this);
        }

        return $this;
    }

    public function removePaciente(Pacientes $paciente): self
    {
        if ($this->pacientes->removeElement($paciente)) {
            // set the owning side to null (unless already changed)
            if ($paciente->getPuestoTrabajo() === $this) {
                $paciente->setPuestoTrabajo(null);
            }
        }

        return $this;
    }

  

  
}
