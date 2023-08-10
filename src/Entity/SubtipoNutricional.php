<?php

namespace App\Entity;

use App\Repository\SubtipoNutricionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubtipoNutricionalRepository::class)
 */
class SubtipoNutricional
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
    private $sub_tipo;

    /**
     * @ORM\ManyToOne(targetEntity=TipoNutricional::class, inversedBy="subtipoNutricionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo_nutricional;

    /**
     * @ORM\OneToMany(targetEntity=Nutricional::class, mappedBy="suptipo_nutricional", orphanRemoval=true)
     */
    private $nutricionals;

    public function __construct()
    {
        $this->nutricionals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubtipo(): ?string
    {
        return $this->sub_tipo;
    }

    public function setSubtipo(?string $sub_tipo): self
    {
        $this->sub_tipo = $sub_tipo;

        return $this;
    }

    public function getTipoNutricional(): ?TipoNutricional
    {
        return $this->tipo_nutricional;
    }

    public function setTipoNutricional(?TipoNutricional $tipo_nutricional): self
    {
        $this->tipo_nutricional = $tipo_nutricional;

        return $this;
    }

    /**
     * @return Collection|Nutricional[]
     */
    public function getNutricionals(): Collection
    {
        return $this->nutricionals;
    }

    public function addNutricional(Nutricional $nutricional): self
    {
        if (!$this->nutricionals->contains($nutricional)) {
            $this->nutricionals[] = $nutricional;
            $nutricional->setSuptipoNutricional($this);
        }

        return $this;
    }

    public function removeNutricional(Nutricional $nutricional): self
    {
        if ($this->nutricionals->removeElement($nutricional)) {
            // set the owning side to null (unless already changed)
            if ($nutricional->getSuptipoNutricional() === $this) {
                $nutricional->setSuptipoNutricional(null);
            }
        }

        return $this;
    }
}
