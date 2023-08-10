<?php

namespace App\Entity;

use App\Repository\ConsultaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultaRepository::class)
 */
class Consulta
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
    private $motivo_consulta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_atencion;

    /**
     * @ORM\ManyToOne(targetEntity=Employed::class, inversedBy="consulta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employed;

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="consulta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

  

    /**
     * @ORM\OneToOne(targetEntity=SignosVitales::class, inversedBy="consulta", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $signos_vitales;

    /**
     * @ORM\OneToMany(targetEntity=Diagnostico::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $diagnosticos;

    /**
     * @ORM\OneToMany(targetEntity=Examenes::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $examenes;

    /**
     * @ORM\OneToMany(targetEntity=Nutricional::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $nutricionals;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_aptitud;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $limitaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $evaluacion_retiro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones_retiro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnostico_nutricional;

    /**
     * @ORM\Column(type="text",nullable=true)
    */
    private $plan_nutricional;

    /**
     * @ORM\Column(type="text",nullable=true)
    */
    private $recomendaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motivo_nutricional;

    /**
     * @ORM\OneToMany(targetEntity=ExamenFisico::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $examen_fisico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $condicion_diagnostico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $condicion_salud;

    /**
     * @ORM\OneToMany(targetEntity=AntHeredofamiliares::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antHeredofamiliares;

    /**
     * @ORM\OneToMany(targetEntity=AntLaborales::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antLaborales;

    /**
     * @ORM\OneToMany(targetEntity=AntNoPatologicos::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antNoPatologicos;

    /**
     * @ORM\OneToMany(targetEntity=AntPatologicos::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antPatologicos;

    /**
     * @ORM\OneToMany(targetEntity=AntQuirugicos::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antQuirugicos;

    /**
     * @ORM\OneToMany(targetEntity=AntReproductivos::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $antReproductivos;

    /**
     * @ORM\OneToMany(targetEntity=OtrosAntecedentes::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $otrosAntecedentes;

  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Estomatogmatico::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $estomatogmaticos;

    /**
     * @ORM\OneToMany(targetEntity=DiagnosticoD::class, mappedBy="consulta", orphanRemoval=true)
     */
    private $diagnosticoDs;


    public function __construct()
    {
      
      
        
        $this->fecha_atencion= new \DateTime();
        $this->diagnosticos = new ArrayCollection();
        $this->examenes = new ArrayCollection();
        $this->nutricionals = new ArrayCollection();
        $this->examen_fisico = new ArrayCollection();
        $this->antHeredofamiliares = new ArrayCollection();
        $this->antLaborales = new ArrayCollection();
        $this->antNoPatologicos = new ArrayCollection();
        $this->antPatologicos = new ArrayCollection();
        $this->antQuirugicos = new ArrayCollection();
        $this->antReproductivos = new ArrayCollection();
        $this->otrosAntecedentes = new ArrayCollection();
        $this->estomatogmaticos = new ArrayCollection();
        $this->diagnosticoDs = new ArrayCollection();
    
      
      
      
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatos(): string
    {
        return $this->motivo_consulta . ' ' . $this->fecha_atencion;
    }

    public function getMotivoConsulta(): ?string
    {
        return $this->motivo_consulta;
    }

    public function setMotivoConsulta(?string $motivo_consulta): self
    {
        $this->motivo_consulta = $motivo_consulta;

        return $this;
    }


    public function getFechaAtencion(): ?\DateTimeInterface
    {
        return $this->fecha_atencion;
    }

    public function setFechaAtencion(?\DateTimeInterface $fecha_atencion): self
    {
        $this->fecha_atencion = $fecha_atencion;

        return $this;
    }

    public function getEmployed(): ?Employed
    {
        return $this->employed;
    }

    public function setEmployed(?Employed $employed): self
    {
        $this->employed = $employed;

        return $this;
    }

    public function getPacientes(): ?Pacientes
    {
        return $this->pacientes;
    }

    public function setPacientes(?Pacientes $pacientes): self
    {
        $this->pacientes = $pacientes;

        return $this;
    }

    

    public function getSignosVitales(): ?SignosVitales
    {
        return $this->signos_vitales;
    }

    public function setSignosVitales(SignosVitales $signos_vitales): self
    {
        $this->signos_vitales = $signos_vitales;

        return $this;
    }

    /**
     * @return Collection|Diagnostico[]
     */
    public function getDiagnosticos(): Collection
    {
        return $this->diagnosticos;
    }

    public function addDiagnostico(Diagnostico $diagnostico): self
    {
        if (!$this->diagnosticos->contains($diagnostico)) {
            $this->diagnosticos[] = $diagnostico;
            $diagnostico->setConsulta($this);
        }

        return $this;
    }

    public function removeDiagnostico(Diagnostico $diagnostico): self
    {
        if ($this->diagnosticos->removeElement($diagnostico)) {
            // set the owning side to null (unless already changed)
            if ($diagnostico->getConsulta() === $this) {
                $diagnostico->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Examenes[]
     */
    public function getExamenes(): Collection
    {
        return $this->examenes;
    }

    public function addExamene(Examenes $examene): self
    {
        if (!$this->examenes->contains($examene)) {
            $this->examenes[] = $examene;
            $examene->setConsulta($this);
        }

        return $this;
    }

    public function removeExamene(Examenes $examene): self
    {
        if ($this->examenes->removeElement($examene)) {
            // set the owning side to null (unless already changed)
            if ($examene->getConsulta() === $this) {
                $examene->setConsulta(null);
            }
        }

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
            $nutricional->setConsulta($this);
        }

        return $this;
    }

    public function removeNutricional(Nutricional $nutricional): self
    {
        if ($this->nutricionals->removeElement($nutricional)) {
            // set the owning side to null (unless already changed)
            if ($nutricional->getConsulta() === $this) {
                $nutricional->setConsulta(null);
            }
        }

        return $this;
    }

    public function getTipoAptitud(): ?string
    {
        return $this->tipo_aptitud;
    }

    public function setTipoAptitud(?string $tipo_aptitud): self
    {
        $this->tipo_aptitud = $tipo_aptitud;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones =  $observaciones;

        return $this;
    }

    public function getLimitaciones(): ?string
    {
        return $this->limitaciones;
    }

    public function setLimitaciones(?string $limitaciones): self
    {
        $this->limitaciones = $limitaciones;

        return $this;
    }

    public function getEvaluacionRetiro(): ?string
    {
        return $this->evaluacion_retiro;
    }

    public function setEvaluacionRetiro(?string $evaluacion_retiro): self
    {
        $this->evaluacion_retiro = $evaluacion_retiro;

        return $this;
    }

    public function getObservacionesRetiro(): ?string
    {
        return $this->observaciones_retiro;
    }

    public function setObservacionesRetiro(?string $observaciones_retiro): self
    {
        $this->observaciones_retiro = $observaciones_retiro;

        return $this;
    }

    public function getDiagnosticoNutricional(): ?string
    {
        return $this->diagnostico_nutricional;
    }

    public function setDiagnosticoNutricional(?string $diagnostico_nutricional): self
    {
        $this->diagnostico_nutricional = strtoupper($diagnostico_nutricional);

        return $this;
    }

    public function getPlanNutricional(): ?string
    {
        return $this->plan_nutricional;
    }

    public function setPlanNutricional(?string $plan_nutricional): self
    {
        $this->plan_nutricional = $plan_nutricional;

        return $this;
    }

    public function getRecomendaciones(): ?string
    {
        return $this->recomendaciones;
    }

    public function setRecomendaciones(?string $recomendaciones): self
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    public function getMotivoNutricional(): ?string
    {
        return $this->motivo_nutricional;
    }

    public function setMotivoNutricional(?string $motivo_nutricional): self
    {
        $this->motivo_nutricional = strtoupper($motivo_nutricional);

        return $this;
    }

    /**
     * @return Collection|ExamenFisico[]
     */
    public function getExamenFisico(): Collection
    {
        return $this->examen_fisico;
    }

    public function addExamenFisico(ExamenFisico $examenFisico): self
    {
        if (!$this->examen_fisico->contains($examenFisico)) {
            $this->examen_fisico[] = $examenFisico;
            $examenFisico->setConsulta($this);
        }

        return $this;
    }

    public function removeExamenFisico(ExamenFisico $examenFisico): self
    {
        if ($this->examen_fisico->removeElement($examenFisico)) {
            // set the owning side to null (unless already changed)
            if ($examenFisico->getConsulta() === $this) {
                $examenFisico->setConsulta(null);
            }
        }

        return $this;
    }

    public function getCondicionDiagnostico(): ?string
    {
        return $this->condicion_diagnostico;
    }

    public function setCondicionDiagnostico(?string $condicion_diagnostico): self
    {
        $this->condicion_diagnostico = $condicion_diagnostico;

        return $this;
    }

    public function getCondicionSalud(): ?string
    {
        return $this->condicion_salud;
    }

    public function setCondicionSalud(?string $condicion_salud): self
    {
        $this->condicion_salud = $condicion_salud;

        return $this;
    }

    /**
     * @return Collection|AntHeredofamiliares[]
     */
    public function getAntHeredofamiliares(): Collection
    {
        return $this->antHeredofamiliares;
    }

    public function addAntHeredofamiliare(AntHeredofamiliares $antHeredofamiliare): self
    {
        if (!$this->antHeredofamiliares->contains($antHeredofamiliare)) {
            $this->antHeredofamiliares[] = $antHeredofamiliare;
            $antHeredofamiliare->setConsulta($this);
        }

        return $this;
    }

    public function removeAntHeredofamiliare(AntHeredofamiliares $antHeredofamiliare): self
    {
        if ($this->antHeredofamiliares->removeElement($antHeredofamiliare)) {
            // set the owning side to null (unless already changed)
            if ($antHeredofamiliare->getConsulta() === $this) {
                $antHeredofamiliare->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntLaborales[]
     */
    public function getAntLaborales(): Collection
    {
        return $this->antLaborales;
    }

    public function addAntLaborale(AntLaborales $antLaborale): self
    {
        if (!$this->antLaborales->contains($antLaborale)) {
            $this->antLaborales[] = $antLaborale;
            $antLaborale->setConsulta($this);
        }

        return $this;
    }

    public function removeAntLaborale(AntLaborales $antLaborale): self
    {
        if ($this->antLaborales->removeElement($antLaborale)) {
            // set the owning side to null (unless already changed)
            if ($antLaborale->getConsulta() === $this) {
                $antLaborale->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntNoPatologicos[]
     */
    public function getAntNoPatologicos(): Collection
    {
        return $this->antNoPatologicos;
    }

    public function addAntNoPatologico(AntNoPatologicos $antNoPatologico): self
    {
        if (!$this->antNoPatologicos->contains($antNoPatologico)) {
            $this->antNoPatologicos[] = $antNoPatologico;
            $antNoPatologico->setConsulta($this);
        }

        return $this;
    }

    public function removeAntNoPatologico(AntNoPatologicos $antNoPatologico): self
    {
        if ($this->antNoPatologicos->removeElement($antNoPatologico)) {
            // set the owning side to null (unless already changed)
            if ($antNoPatologico->getConsulta() === $this) {
                $antNoPatologico->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntPatologicos[]
     */
    public function getAntPatologicos(): Collection
    {
        return $this->antPatologicos;
    }

    public function addAntPatologico(AntPatologicos $antPatologico): self
    {
        if (!$this->antPatologicos->contains($antPatologico)) {
            $this->antPatologicos[] = $antPatologico;
            $antPatologico->setConsulta($this);
        }

        return $this;
    }

    public function removeAntPatologico(AntPatologicos $antPatologico): self
    {
        if ($this->antPatologicos->removeElement($antPatologico)) {
            // set the owning side to null (unless already changed)
            if ($antPatologico->getConsulta() === $this) {
                $antPatologico->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntQuirugicos[]
     */
    public function getAntQuirugicos(): Collection
    {
        return $this->antQuirugicos;
    }

    public function addAntQuirugico(AntQuirugicos $antQuirugico): self
    {
        if (!$this->antQuirugicos->contains($antQuirugico)) {
            $this->antQuirugicos[] = $antQuirugico;
            $antQuirugico->setConsulta($this);
        }

        return $this;
    }

    public function removeAntQuirugico(AntQuirugicos $antQuirugico): self
    {
        if ($this->antQuirugicos->removeElement($antQuirugico)) {
            // set the owning side to null (unless already changed)
            if ($antQuirugico->getConsulta() === $this) {
                $antQuirugico->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntReproductivos[]
     */
    public function getAntReproductivos(): Collection
    {
        return $this->antReproductivos;
    }

    public function addAntReproductivo(AntReproductivos $antReproductivo): self
    {
        if (!$this->antReproductivos->contains($antReproductivo)) {
            $this->antReproductivos[] = $antReproductivo;
            $antReproductivo->setConsulta($this);
        }

        return $this;
    }

    public function removeAntReproductivo(AntReproductivos $antReproductivo): self
    {
        if ($this->antReproductivos->removeElement($antReproductivo)) {
            // set the owning side to null (unless already changed)
            if ($antReproductivo->getConsulta() === $this) {
                $antReproductivo->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OtrosAntecedentes[]
     */
    public function getOtrosAntecedentes(): Collection
    {
        return $this->otrosAntecedentes;
    }

    public function addOtrosAntecedente(OtrosAntecedentes $otrosAntecedente): self
    {
        if (!$this->otrosAntecedentes->contains($otrosAntecedente)) {
            $this->otrosAntecedentes[] = $otrosAntecedente;
            $otrosAntecedente->setConsulta($this);
        }

        return $this;
    }

    public function removeOtrosAntecedente(OtrosAntecedentes $otrosAntecedente): self
    {
        if ($this->otrosAntecedentes->removeElement($otrosAntecedente)) {
            // set the owning side to null (unless already changed)
            if ($otrosAntecedente->getConsulta() === $this) {
                $otrosAntecedente->setConsulta(null);
            }
        }

        return $this;
    }

  

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Estomatogmatico>
     */
    public function getEstomatogmaticos(): Collection
    {
        return $this->estomatogmaticos;
    }

    public function addEstomatogmatico(Estomatogmatico $estomatogmatico): self
    {
        if (!$this->estomatogmaticos->contains($estomatogmatico)) {
            $this->estomatogmaticos[] = $estomatogmatico;
            $estomatogmatico->setConsulta($this);
        }

        return $this;
    }

    public function removeEstomatogmatico(Estomatogmatico $estomatogmatico): self
    {
        if ($this->estomatogmaticos->removeElement($estomatogmatico)) {
            // set the owning side to null (unless already changed)
            if ($estomatogmatico->getConsulta() === $this) {
                $estomatogmatico->setConsulta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DiagnosticoD>
     */
    public function getDiagnosticoDs(): Collection
    {
        return $this->diagnosticoDs;
    }

    public function addDiagnosticoD(DiagnosticoD $diagnosticoD): self
    {
        if (!$this->diagnosticoDs->contains($diagnosticoD)) {
            $this->diagnosticoDs[] = $diagnosticoD;
            $diagnosticoD->setConsulta($this);
        }

        return $this;
    }

    public function removeDiagnosticoD(DiagnosticoD $diagnosticoD): self
    {
        if ($this->diagnosticoDs->removeElement($diagnosticoD)) {
            // set the owning side to null (unless already changed)
            if ($diagnosticoD->getConsulta() === $this) {
                $diagnosticoD->setConsulta(null);
            }
        }

        return $this;
    }
}
