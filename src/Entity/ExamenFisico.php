<?php

namespace App\Entity;

use App\Repository\ExamenFisicoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExamenFisicoRepository::class)
 */
class ExamenFisico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $piel =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $ojos =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $oido =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $oro_farinje =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $nariz =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $cuello =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $torax1 =[];

   

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $abdomen =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $columna =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $pelvis =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $extremidades =[];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $neurologico =[];

    /**
     * @ORM\Column(type="string",length=1000, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="examen_fisico")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consulta;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPiel(): ?array
    {
        $piel= $this->piel;
        return array_unique($piel);
    }

    public function setPiel(?array $piel): self
    {
        $this->piel = $piel;

        return $this;
    }

    public function getOjos(): ?array
    {
        $ojos= $this->ojos;
        return array_unique($ojos);
    }

    public function setOjos(?array $ojos): self
    {
        $this->ojos = $ojos;

        return $this;
    }

    public function getOido(): ?array
    {
        $oido= $this->oido;
        return array_unique($oido);
    }

    public function setOido(array $oido): self
    {
        $this->oido = $oido;

        return $this;
    }

    public function getOroFarinje(): ?array
    {
        $oro_farinje= $this->oro_farinje;
        return array_unique($oro_farinje);

    }

    public function setOroFarinje(?array $oro_farinje): self
    {
        $this->oro_farinje = $oro_farinje;

        return $this;
    }

    public function getNariz(): ?array
    {
        $nariz= $this->nariz;
        return array_unique($nariz);
    }

    public function setNariz(?array $nariz): self
    {
        $this->nariz = $nariz;

        return $this;
    }

    public function getCuello(): ?array
    {
        $cuello= $this->cuello;
        return array_unique($cuello);
    }

    public function setCuello(?array $cuello): self
    {
        $this->cuello = $cuello;

        return $this;
    }

    public function getTorax1(): ?array
    {
        $torax1= $this->torax1;
        return array_unique($torax1);
    }

    public function setTorax1(?array $torax1): self
    {
        $this->torax1 = $torax1;

        return $this;
    }

  

    public function getAbdomen(): ?array
    {
        $abdomen= $this->abdomen;
        return array_unique($abdomen);
    }


    public function setAbdomen(?array $abdomen): self
    {
        $this->abdomen = $abdomen;

        return $this;
    }

    public function getColumna(): ?array
    {
        $columna= $this->columna;
        return array_unique($columna);
    }

    public function setColumna(?array $columna): self
    {
        $this->columna = $columna;

        return $this;
    }

    public function getPelvis(): ?array
    {
        $pelvis= $this->pelvis;
        return array_unique($pelvis);
    }

    public function setPelvis(?array $pelvis): self
    {
        $this->pelvis = $pelvis;

        return $this;
    }

    public function getExtremidades(): ?array
    {
        $extremidades= $this->extremidades;
        return array_unique($extremidades);
    }

    public function setExtremidades(?array $extremidades): self
    {
        $this->extremidades = $extremidades;

        return $this;
    }

    public function getNeurologico(): ?array 
    {
        $neurologico= $this->neurologico;
        return array_unique($neurologico);
    }

    public function setNeurologico(?array $neurologico): self
    {
        $this->neurologico = $neurologico;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = strtoupper($observaciones);

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
}
