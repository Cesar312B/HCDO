<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvinciaRepository::class)
 */
class Provincia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pais;

    /**
     * @ORM\OneToMany(targetEntity=Ciudad::class, mappedBy="provincia", orphanRemoval=true)
     */
    private $ciudad;

    public function __construct()
    {
        $this->ciudad = new ArrayCollection();
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

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }

    /**
     * @return Collection|Ciudad[]
     */
    public function getCiudad(): Collection
    {
        return $this->ciudad;
    }



    public function addCiudad(Ciudad $ciudad): self
    {
        if (!$this->ciudad->contains($ciudad)) {
            $this->ciudad[] = $ciudad;
            $ciudad->setProvincia($this);
        }

        return $this;
    }

    public function removeCiudad(Ciudad $ciudad): self
    {
        if ($this->ciudad->removeElement($ciudad)) {
            // set the owning side to null (unless already changed)
            if ($ciudad->getProvincia() === $this) {
                $ciudad->setProvincia(null);
            }
        }
        return $this;
    }

    
}
