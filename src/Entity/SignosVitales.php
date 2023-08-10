<?php

namespace App\Entity;

use App\Repository\SignosVitalesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=SignosVitalesRepository::class)
 */
class SignosVitales
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 50,
     *      max = 300,
     *      minMessage = "Debes ser al menos {{ limit }}Metros",
     *      maxMessage = "Valor maximo permitido {{ limit }}Metros"
     * )
     */
    private $estatura;

    /**
     * @ORM\Column(type="float", nullable=true)
    * @Assert\Range(
     *      min = 25.00,
     *      max = 500.00,
     *      minMessage = "Debes ser al menos {{ limit }}Kg",
     *      maxMessage = "Valor maximo permitido {{ limit }}kg"
     * )
     * 
     */
    private $peso;

  

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Range(
     *      min = 34.00,
     *      max = 39.00,
     *      minMessage = "{{ limit }}grados",
     *      maxMessage = "{{ limit }}grados"
     * )
     */
    private $temperatura;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 9,
     *      max = 21,
     *      minMessage = "{{ limit }}",
     *      maxMessage = "{{ limit }}"
     * )
     */
    private $frecuencia_respiratoria;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sistole;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diastole;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 40,
     *      max = 120,
     *      minMessage = "{{ limit }}pulsos",
     *      maxMessage = "{{ limit }}pulsos"
     * )
     */
    private $frecuencia_cardiaca;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $grasa_corporal;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $masa_muscular;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $saturacion_oxigeno;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $grasa_visceral;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $hidratacion;

    /**
     * @ORM\OneToOne(targetEntity=Consulta::class, mappedBy="signos_vitales", cascade={"persist", "remove"})
     */
    private $consulta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cintura;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $glucosa_ayunas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $glucosa_post;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstatura(): ?int
    {
        return $this->estatura;
    }

    public function setEstatura(?float $estatura): self
    {
        $this->estatura = $estatura;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(?float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }



    public function getTemperatura(): ?float
    {
        return $this->temperatura;
    }

    public function setTemperatura(?float $temperatura): self
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    public function getFrecuenciaRespiratoria(): ?int
    {
        return $this->frecuencia_respiratoria;
    }

    public function setFrecuenciaRespiratoria(?int $frecuencia_respiratoria): self
    {
        $this->frecuencia_respiratoria = $frecuencia_respiratoria;

        return $this;
    }

    public function getSistole(): ?float
    {
        return $this->sistole;
    }

    public function setSistole(?float $sistole): self
    {
        $this->sistole = $sistole;

        return $this;
    }


    public function getFrecuenciaCardiaca(): ?int
    {
        return $this->frecuencia_cardiaca;
    }

    public function setFrecuenciaCardiaca(?int $frecuencia_cardiaca): self
    {
        $this->frecuencia_cardiaca = $frecuencia_cardiaca;

        return $this;
    }

    public function getGrasaCorporal(): ?float
    {
        return $this->grasa_corporal;
    }

    public function setGrasaCorporal(?float $grasa_corporal): self
    {
        $this->grasa_corporal = $grasa_corporal;

        return $this;
    }

    public function getMasaMuscular(): ?string
    {
        return $this->masa_muscular;
    }

    public function setMasaMuscular(?string $masa_muscular): self
    {
        $this->masa_muscular = $masa_muscular;

        return $this;
    }

    public function getSaturacionOxigeno(): ?float
    {
        return $this->saturacion_oxigeno;
    }

    public function setSaturacionOxigeno(?float $saturacion_oxigeno): self
    {
        $this->saturacion_oxigeno = $saturacion_oxigeno;

        return $this;
    }

    public function getGrasaVisceral(): ?float
    {
        return $this->grasa_visceral;
    }

    public function setGrasaVisceral(?float $grasa_visceral): self
    {
        $this->grasa_visceral = $grasa_visceral;

        return $this;
    }

    public function getHidratacion(): ?string
    {
        return $this->hidratacion;
    }

    public function setHidratacion(?string $hidratacion): self
    {
        $this->hidratacion = $hidratacion;

        return $this;
    }

    public function getConsulta(): ?Consulta
    {
        return $this->consulta;
    }

    public function setConsulta(Consulta $consulta): self
    {
        $this->consulta = $consulta;

        // set the owning side of the relation if necessary
        if ($consulta->getSignosVitales() !== $this) {
            $consulta->setSignosVitales($this);
        }

        return $this;
    }

    public function getCintura(): ?float
    {
        return $this->cintura;
    }

    public function setCintura(?float $cintura): self
    {
        $this->cintura = $cintura;

        return $this;
    }

    public function getGlucosaAyunas(): ?int
    {
        return $this->glucosa_ayunas;
    }

    public function setGlucosaAyunas(?int $glucosa_ayunas): self
    {
        $this->glucosa_ayunas = $glucosa_ayunas;

        return $this;
    }

    public function getGlucosaPost(): ?int
    {
        return $this->glucosa_post;
    }

    public function setGlucosaPost(?int $glucosa_post): self
    {
        $this->glucosa_post = $glucosa_post;

        return $this;
    }

    public function getDiastole(): ?int
    {
        return $this->diastole;
    }

    public function setDiastole(?int $diastole): self
    {
        $this->diastole = $diastole;

        return $this;
    } 
}
