<?php

namespace App\Entity;

use App\Repository\TipoNutricionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoNutricionalRepository::class)
 */
class TipoNutricional
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
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity=SubtipoNutricional::class, mappedBy="tipo_nutricional", orphanRemoval=true)
     */
    private $subtipoNutricionals;

    public function __construct()
    {
        $this->subtipoNutricionals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection|SubtipoNutricional[]
     */
    public function getSubtipoNutricionals(): Collection
    {
        return $this->subtipoNutricionals;
    }

    public function addSubtipoNutricional(SubtipoNutricional $subtipoNutricional): self
    {
        if (!$this->subtipoNutricionals->contains($subtipoNutricional)) {
            $this->subtipoNutricionals[] = $subtipoNutricional;
            $subtipoNutricional->setTipoNutricional($this);
        }

        return $this;
    }

    public function removeSubtipoNutricional(SubtipoNutricional $subtipoNutricional): self
    {
        if ($this->subtipoNutricionals->removeElement($subtipoNutricional)) {
            // set the owning side to null (unless already changed)
            if ($subtipoNutricional->getTipoNutricional() === $this) {
                $subtipoNutricional->setTipoNutricional(null);
            }
        }

        return $this;
    }
}
