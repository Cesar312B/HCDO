<?php

namespace App\Entity;

use App\Repository\UnidadesoperativasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UnidadesoperativasRepository::class)
 */
class Unidadesoperativas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100,  nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=80,nullable=true )
     */
    private $regional;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=Employed::class, mappedBy="unidadesoperativas")
     */
    private $employed;




    public function __construct()
    {
        $this->estado = true;
        $this->employed = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getRegional(): ?string
    {
        return $this->regional;
    }

    public function setRegional(?string $regional): self
    {
        $this->regional = $regional;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection|Employed[]
     */
    public function getEmployed(): Collection
    {
        return $this->employed;
    }

    public function addEmployed(Employed $employed): self
    {
        if (!$this->employed->contains($employed)) {
            $this->employed[] = $employed;
            $employed->setUnidadesoperativas($this);
        }

        return $this;
    }

    public function removeEmployed(Employed $employed): self
    {
        if ($this->employed->removeElement($employed)) {
            // set the owning side to null (unless already changed)
            if ($employed->getUnidadesoperativas() === $this) {
                $employed->setUnidadesoperativas(null);
            }
        }

        return $this;
    }

 


}
