<?php

namespace App\Entity;

use App\Repository\AntPatologicosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntPatologicosRepository::class)
 */
class AntPatologicos
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
    private $piel_anexos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $organos_sentidos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $respiratorio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cardiovascular;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $digestivo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genito_urinario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $musculo_esqueletico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $endocrino;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hemolinfatico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nervioso;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enfermedad_actual;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="antPatologicos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="antPatologicos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $consulta;

       /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creatdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPielAnexos(): ?string
    {
        return $this->piel_anexos;
    }

    public function setPielAnexos(?string $piel_anexos): self
    {
        $this->piel_anexos = strtoupper($piel_anexos);

        return $this;
    }

    public function getOrganosSentidos(): ?string
    {
        return $this->organos_sentidos;
    }

    public function setOrganosSentidos(?string $organos_sentidos): self
    {
        $this->organos_sentidos = strtoupper($organos_sentidos);

        return $this;
    }

    public function getRespiratorio(): ?string
    {
        return $this->respiratorio;
    }

    public function setRespiratorio(?string $respiratorio): self
    {
        $this->respiratorio = strtoupper($respiratorio);

        return $this;
    }

    public function getCardiovascular(): ?string
    {
        return $this->cardiovascular;
    }

    public function setCardiovascular(?string $cardiovascular): self
    {
        $this->cardiovascular = strtoupper($cardiovascular);

        return $this;
    }

    public function getDigestivo(): ?string
    {
        return $this->digestivo;
    }

    public function setDigestivo(?string $digestivo): self
    {
        $this->digestivo = strtoupper($digestivo);

        return $this;
    }

    public function getGenitoUrinario(): ?string
    {
        return $this->genito_urinario;
    }

    public function setGenitoUrinario(?string $genito_urinario): self
    {
        $this->genito_urinario = strtoupper($genito_urinario);

        return $this;
    }

    public function getMusculoEsqueletico(): ?string
    {
        return $this->musculo_esqueletico;
    }

    public function setMusculoEsqueletico(?string $musculo_esqueletico): self
    {
        $this->musculo_esqueletico = strtoupper($musculo_esqueletico);

        return $this;
    }

    public function getEndocrino(): ?string
    {
        return $this->endocrino;
    }

    public function setEndocrino(?string $endocrino): self
    {
        $this->endocrino = strtoupper($endocrino);

        return $this;
    }

    public function getHemolinfatico(): ?string
    {
        return $this->hemolinfatico;
    }

    public function setHemolinfatico(?string $hemolinfatico): self
    {
        $this->hemolinfatico = strtoupper($hemolinfatico);

        return $this;
    }

    public function getNervioso(): ?string
    {
        return $this->nervioso;
    }

    public function setNervioso(?string $nervioso): self
    {
        $this->nervioso = strtoupper($nervioso);

        return $this;
    }

    
  

    public function getEnfermedadActual(): ?string
    {
        return $this->enfermedad_actual;
    }

    public function setEnfermedadActual(?string $enfermedad_actual): self
    {
        $this->enfermedad_actual = strtoupper($enfermedad_actual);

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

    public function getPacientes(): ?Pacientes
    {
        return $this->pacientes;
    }

    public function setPacientes(?Pacientes $pacientes): self
    {
        $this->pacientes =  $pacientes;

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

    public function getCreatdate(): ?\DateTimeInterface
    {
        return $this->creatdate;
    }

    public function setCreatdate(?\DateTimeInterface $creatdate): self
    {
        $this->creatdate = $creatdate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(?\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }
}
