<?php

namespace App\Entity;

use App\Repository\MedicamentosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=MedicamentosRepository::class)
 */
class Medicamentos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $principio_activo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $laboratorio;

    /**
     * @ORM\Column(type="string",length=10,nullable=true)
     */
    private $fraccion;

    /**
     * @ORM\OneToMany(targetEntity=Tratamiento::class, mappedBy="medicamentos", orphanRemoval=true)
     */
    private $tratamientos;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Clasificacion;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Marca;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado_producto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $presentacion_producto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mercado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iva;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $generico;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $portafolio_cat;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

  

  

    public function __construct()
    {
        $this->tratamientos = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrincipioActivo(): ?string
    {
        return $this->principio_activo;
    }

    public function setPrincipioActivo(?string $principio_activo): self
    {
        $this->principio_activo = $principio_activo;

        return $this;
    }

    public function getLaboratorio(): ?string
    {
        return $this->laboratorio;
    }

    public function setLaboratorio(?string $laboratorio): self
    {
        $this->laboratorio = $laboratorio;

        return $this;
    }

    public function getFraccion(): ?string
    {
        return $this->fraccion;
    }

    public function setFraccion(?string $fraccion): self
    {
        $this->fraccion = $fraccion;

        return $this;
    }

    /**
     * @return Collection|Tratamiento[]
     */
    public function getTratamientos(): Collection
    {
        return $this->tratamientos;
    }

    public function addTratamiento(Tratamiento $tratamiento): self
    {
        if (!$this->tratamientos->contains($tratamiento)) {
            $this->tratamientos[] = $tratamiento;
            $tratamiento->setMedicamentos($this);
        }

        return $this;
    }

    public function removeTratamiento(Tratamiento $tratamiento): self
    {
        if ($this->tratamientos->removeElement($tratamiento)) {
            // set the owning side to null (unless already changed)
            if ($tratamiento->getMedicamentos() === $this) {
                $tratamiento->setMedicamentos(null);
            }
        }

        return $this;
    }

    public function getClasificacion(): ?string
    {
        return $this->Clasificacion;
    }

    public function setClasificacion(?string $Clasificacion): self
    {
        $this->Clasificacion = $Clasificacion;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->Marca;
    }

    public function setMarca(?string $Marca): self
    {
        $this->Marca = $Marca;

        return $this;
    }

    public function getEstadoProducto(): ?string
    {
        return $this->estado_producto;
    }

    public function setEstadoProducto(?string $estado_producto): self
    {
        $this->estado_producto = $estado_producto;

        return $this;
    }

    public function getPresentacionProducto(): ?int
    {
        return $this->presentacion_producto;
    }

    public function setPresentacionProducto(?int $presentacion_producto): self
    {
        $this->presentacion_producto = $presentacion_producto;

        return $this;
    }

    public function getMercado(): ?string
    {
        return $this->mercado;
    }

    public function setMercado(?string $mercado): self
    {
        $this->mercado = $mercado;

        return $this;
    }

    public function getIva(): ?string
    {
        return $this->iva;
    }

    public function setIva(?string $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getGenerico(): ?string
    {
        return $this->generico;
    }

    public function setGenerico(?string $generico): self
    {
        $this->generico = $generico;

        return $this;
    }

    public function getPortafolioCat(): ?string
    {
        return $this->portafolio_cat;
    }

    public function setPortafolioCat(?string $portafolio_cat): self
    {
        $this->portafolio_cat = $portafolio_cat;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }


   

}
