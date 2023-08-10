<?php

namespace App\Entity;

use App\Repository\LaboratorioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaboratorioRepository::class)
 */
class Laboratorio
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
    private $hematologia = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $coagulación = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $serologia = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $orina = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $heces = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $inmunologia = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $bacteriologia = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $bioquimica = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $enzimologia = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $electrolitos = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $drogas = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $hormonas = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $tumorales = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $infecciones = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $tiroideo = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $prequirofano = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $prostatico = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $ejecutivo = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $estudiantil = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $COVID19 = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHematologia(): ?array
    {
        return $this->hematologia;
    }

    public function setHematologia(?array $hematologia): self
    {
        $this->hematologia = $hematologia;

        return $this;
    }

    public function getCoagulación(): ?array
    {
        return $this->coagulación;
    }

    public function setCoagulación(?array $coagulación): self
    {
        $this->coagulación = $coagulación;

        return $this;
    }

    public function getSerologia(): ?array
    {
        return $this->serologia;
    }

    public function setSerologia(?array $serologia): self
    {
        $this->serologia = $serologia;

        return $this;
    }

    public function getOrina(): ?array
    {
        return $this->orina;
    }

    public function setOrina(?array $orina): self
    {
        $this->orina = $orina;

        return $this;
    }

    public function getHeces(): ?array
    {
        return $this->heces;
    }

    public function setHeces(?array $heces): self
    {
        $this->heces = $heces;

        return $this;
    }

    public function getInmunologia(): ?array
    {
        return $this->inmunologia;
    }

    public function setInmunologia(?array $inmunologia): self
    {
        $this->inmunologia = $inmunologia;

        return $this;
    }

    public function getBacteriologia(): ?array
    {
        return $this->bacteriologia;
    }

    public function setBacteriologia(?array $bacteriologia): self
    {
        $this->bacteriologia = $bacteriologia;

        return $this;
    }

    public function getBioquimica(): ?array
    {
        return $this->bioquimica;
    }

    public function setBioquimica(?array $bioquimica): self
    {
        $this->bioquimica = $bioquimica;

        return $this;
    }

    public function getEnzimologia(): ?array
    {
        return $this->enzimologia;
    }

    public function setEnzimologia(?array $enzimologia): self
    {
        $this->enzimologia = $enzimologia;

        return $this;
    }

    public function getElectrolitos(): ?array
    {
        return $this->electrolitos;
    }

    public function setElectrolitos(?array $electrolitos): self
    {
        $this->electrolitos = $electrolitos;

        return $this;
    }

    public function getDrogas(): ?array
    {
        return $this->drogas;
    }

    public function setDrogas(?array $drogas): self
    {
        $this->drogas = $drogas;

        return $this;
    }

    public function getHormonas(): ?array
    {
        return $this->hormonas;
    }

    public function setHormonas(?array $hormonas): self
    {
        $this->hormonas = $hormonas;

        return $this;
    }

    public function getTumorales(): ?array
    {
        return $this->tumorales;
    }

    public function setTumorales(?array $tumorales): self
    {
        $this->tumorales = $tumorales;

        return $this;
    }

    public function getInfecciones(): ?array
    {
        return $this->infecciones;
    }

    public function setInfecciones(?array $infecciones): self
    {
        $this->infecciones = $infecciones;

        return $this;
    }

    public function getTiroideo(): ?array
    {
        return $this->tiroideo;
    }

    public function setTiroideo(?array $tiroideo): self
    {
        $this->tiroideo = $tiroideo;

        return $this;
    }

    public function getPrequirofano(): ?array
    {
        return $this->prequirofano;
    }

    public function setPrequirofano(?array $prequirofano): self
    {
        $this->prequirofano = $prequirofano;

        return $this;
    }

    public function getProstatico(): ?array
    {
        return $this->prostatico;
    }

    public function setProstatico(?array $prostatico): self
    {
        $this->prostatico = $prostatico;

        return $this;
    }

    public function getEjecutivo(): ?array
    {
        return $this->ejecutivo;
    }

    public function setEjecutivo(?array $ejecutivo): self
    {
        $this->ejecutivo = $ejecutivo;

        return $this;
    }

    public function getEstudiantil(): ?array
    {
        return $this->estudiantil;
    }

    public function setEstudiantil(?array $estudiantil): self
    {
        $this->estudiantil = $estudiantil;

        return $this;
    }

    public function getCOVID19(): ?array
    {
        return $this->COVID19;
    }

    public function setCOVID19(?array $COVID19): self
    {
        $this->COVID19 = $COVID19;

        return $this;
    }
}
