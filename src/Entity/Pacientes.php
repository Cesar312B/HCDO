<?php

namespace App\Entity;

use App\Repository\PacientesRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PacientesRepository::class)
 * @UniqueEntity(fields={"cedula"}, message="Esta cedula ya existe")
 */
class Pacientes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $tipo_identificacion;


    /**
     * @ORM\Column(type="string",length=17,unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      max = 17,
     * )
     */
    private $cedula;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $pnombre;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $snombre;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $papellido;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $sapellido;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $sexo;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Range(
     *      max = "now"
     * )
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tipo_sangre;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $discapacidad = [];

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tipo_discapacidad;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $religion;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $identidad_genero;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es valido."
     * )
     */
    private $email_paciente;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 30,
     * )
     */
    private $celular;

  

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Range(
     *      max = "now"
     * )
     */
    private $fecha_ingreso;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $historia_clinica;

    /**
     * @ORM\ManyToOne(targetEntity=Ciudad::class, inversedBy="pacientes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ciudad;

    /**
     * @ORM\OneToMany(targetEntity=Consulta::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $consulta;

    /**
     * @ORM\OneToMany(targetEntity=AntNoPatologicos::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antNoPatologicos;

    /**
     * @ORM\OneToMany(targetEntity=AntPatologicos::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antPatologicos;

    /**
     * @ORM\OneToMany(targetEntity=AntReproductivos::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antReproductivos;

    /**
     * @ORM\OneToMany(targetEntity=Diagnostico::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $diagnosticos;

    /**
     * @ORM\OneToMany(targetEntity=OtrosAntecedentes::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $otrosAntecedentes;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $posicion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $identificacion_etnica;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nivel_instruccion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calle_principal;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $numero_casa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calle_secundaria;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etnia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $is_active;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $orientacion_sexual;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lateralidad;

    /**
     * @ORM\OneToMany(targetEntity=AntHeredofamiliares::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antHeredofamiliares;

    /**
     * @ORM\ManyToOne(targetEntity=PuestoTrabajo::class, inversedBy="pacientes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $puesto_trabajo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aptitudes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @ORM\OneToMany(targetEntity=AntQuirugicos::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antQuirugicos;

    /**
     * @ORM\OneToMany(targetEntity=AntLaborales::class, mappedBy="pacientes", orphanRemoval=true)
     */
    private $antLaborales;



 
  

    public function __construct()
    {
        $this->consulta = new ArrayCollection();
        $this->antNoPatologicos = new ArrayCollection();
        $this->antPatologicos = new ArrayCollection();
        $this->antReproductivos = new ArrayCollection();
        $this->diagnosticos = new ArrayCollection();
        $this->otrosAntecedentes = new ArrayCollection();
        $this->antHeredofamiliares = new ArrayCollection();
        $this->antQuirugicos = new ArrayCollection();
        $this->antLaborales = new ArrayCollection();
        $this->fecha_ingreso= new \DateTime();
     
    }


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoIdentificacion(): ?string
    {
        return $this->tipo_identificacion;
    }

    public function setTipoIdentificacion(?string $tipo_identificacion): self
    {
        $this->tipo_identificacion = $tipo_identificacion;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(?string $cedula): self
    {
        $this->cedula = $cedula;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPnombre(): ?string
    {
        return $this->pnombre;
    }

    public function setPnombre(?string $pnombre): self
    {
        $this->pnombre = strtoupper($pnombre);

        return $this;
    }

    public function getSnombre(): ?string
    {
        return $this->snombre;
    }

    public function setSnombre(?string $snombre): self
    {
        $this->snombre = strtoupper($snombre);

        return $this;
    }

    public function getPapellido(): ?string
    {
        return $this->papellido;
    }

    public function setPapellido(?string $papellido): self
    {
        $this->papellido = strtoupper($papellido);

        return $this;
    }

    public function getSapellido(): ?string
    {
        return $this->sapellido;
    }

    public function setSapellido(?string $sapellido): self
    {
        $this->sapellido = strtoupper($sapellido);

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estado_civil;
    }

    public function setEstadoCivil(?string $estado_civil): self
    {
        $this->estado_civil = $estado_civil;

        return $this;
    }

    public function getTipoSangre(): ?string
    {
        return $this->tipo_sangre;
    }

    public function setTipoSangre(?string $tipo_sangre): self
    {
        $this->tipo_sangre = $tipo_sangre;

        return $this;
    }

    public function getDiscapacidad(): array
    {
        $discapacidad = $this->discapacidad;
        return array($discapacidad);
    }

    public function setDiscapacidad(array $discapacidad): self
    {
        $this->discapacidad = $discapacidad;

        return $this;
    }

    public function getTipoDiscapacidad(): ?string
    {
        return $this->tipo_discapacidad;
    }

    public function setTipoDiscapacidad(?string $tipo_discapacidad): self
    {
        $this->tipo_discapacidad = strtoupper($tipo_discapacidad);

        return $this;
    }

    public function getReligion(): ?string
    {
        return $this->religion;
    }

    public function setReligion(?string $religion): self
    {
        $this->religion = $religion;

        return $this;
    }

    public function getIdentidadGenero(): ?string
    {
        return $this->identidad_genero;
    }

    public function setIdentidadGenero(?string $identidad_genero): self
    {
        $this->identidad_genero = $identidad_genero;

        return $this;
    }

    public function getEmailPaciente(): ?string
    {
        return $this->email_paciente;
    }

    public function setEmailPaciente(?string $email_paciente): self
    {
        $this->email_paciente = $email_paciente;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

  

  

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fecha_ingreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $fecha_ingreso): self
    {
        $this->fecha_ingreso = $fecha_ingreso;

        return $this;
    }

    public function getHistoriaClinica(): ?string
    {
        return $this->historia_clinica;
    }

    public function setHistoriaClinica(string $historia_clinica): self
    {
        $this->historia_clinica = $historia_clinica;

        return $this;
    }


    public function getCiudad(): ?Ciudad
    {
        return $this->ciudad;
    }

    public function setCiudad(?Ciudad $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * @return Collection|Consulta[]
     */
    public function getConsulta(): Collection
    {
        return $this->consulta;
    }

    public function addConsultum(Consulta $consultum): self
    {
        if (!$this->consulta->contains($consultum)) {
            $this->consulta[] = $consultum;
            $consultum->setPacientes($this);
        }

        return $this;
    }

    public function removeConsultum(Consulta $consultum): self
    {
        if ($this->consulta->removeElement($consultum)) {
            // set the owning side to null (unless already changed)
            if ($consultum->getPacientes() === $this) {
                $consultum->setPacientes(null);
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
            $antNoPatologico->setPacientes($this);
        }

        return $this;
    }

    public function removeAntNoPatologico(AntNoPatologicos $antNoPatologico): self
    {
        if ($this->antNoPatologicos->removeElement($antNoPatologico)) {
            // set the owning side to null (unless already changed)
            if ($antNoPatologico->getPacientes() === $this) {
                $antNoPatologico->setPacientes(null);
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
            $antPatologico->setPacientes($this);
        }

        return $this;
    }

    public function removeAntPatologico(AntPatologicos $antPatologico): self
    {
        if ($this->antPatologicos->removeElement($antPatologico)) {
            // set the owning side to null (unless already changed)
            if ($antPatologico->getPacientes() === $this) {
                $antPatologico->setPacientes(null);
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
            $antReproductivo->setPacientes($this);
        }

        return $this;
    }

    public function removeAntReproductivo(AntReproductivos $antReproductivo): self
    {
        if ($this->antReproductivos->removeElement($antReproductivo)) {
            // set the owning side to null (unless already changed)
            if ($antReproductivo->getPacientes() === $this) {
                $antReproductivo->setPacientes(null);
            }
        }

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
            $diagnostico->setPacientes($this);
        }

        return $this;
    }

    public function removeDiagnostico(Diagnostico $diagnostico): self
    {
        if ($this->diagnosticos->removeElement($diagnostico)) {
            // set the owning side to null (unless already changed)
            if ($diagnostico->getPacientes() === $this) {
                $diagnostico->setPacientes(null);
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
            $otrosAntecedente->setPacientes($this);
        }

        return $this;
    }

    public function removeOtrosAntecedente(OtrosAntecedentes $otrosAntecedente): self
    {
        if ($this->otrosAntecedentes->removeElement($otrosAntecedente)) {
            // set the owning side to null (unless already changed)
            if ($otrosAntecedente->getPacientes() === $this) {
                $otrosAntecedente->setPacientes(null);
            }
        }

        return $this;
    }

    public function getPosicion(): ?string
    {
        return $this->posicion;
    }

    public function setPosicion(?string $posicion): self
    {
        $this->posicion = $posicion;

        return $this;
    }

    public function getIdentificacionEtnica(): ?string
    {
        return $this->identificacion_etnica;
    }

    public function setIdentificacionEtnica(?string $identificacion_etnica): self
    {
        $this->identificacion_etnica = $identificacion_etnica;

        return $this;
    }

    public function getNivelInstruccion(): ?string
    {
        return $this->nivel_instruccion;
    }

    public function setNivelInstruccion(?string $nivel_instruccion): self
    {
        $this->nivel_instruccion = $nivel_instruccion;

        return $this;
    }

    public function getCallePrincipal(): ?string
    {
        return $this->calle_principal;
    }

    public function setCallePrincipal(?string $calle_principal): self
    {
        $this->calle_principal = strtoupper($calle_principal);

        return $this;
    }

    public function getNumeroCasa(): ?string
    {
        return $this->numero_casa;
    }

    public function setNumeroCasa(?string $numero_casa): self
    {
        $this->numero_casa = strtoupper($numero_casa);

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): self
    {
        $this->sector = strtoupper($sector);

        return $this;
    }

    public function getCalleSecundaria(): ?string
    {
        return $this->calle_secundaria;
    }

    public function setCalleSecundaria(?string $calle_secundaria): self
    {
        $this->calle_secundaria = strtoupper($calle_secundaria);

        return $this;
    }

    public function getEtnia(): ?string
    {
        return $this->etnia;
    }

    public function setEtnia(?string $etnia): self
    {
        $this->etnia = $etnia;

        return $this;
    }

    public function getIsActive(): ?string
    {
        return $this->is_active;
    }

    public function setIsActive(?string $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getOrientacionSexual(): ?string
    {
        return $this->orientacion_sexual;
    }

    public function setOrientacionSexual(?string $orientacion_sexual): self
    {
        $this->orientacion_sexual = $orientacion_sexual;

        return $this;
    }

    public function getLateralidad(): ?string
    {
        return $this->lateralidad;
    }

    public function setLateralidad(?string $lateralidad): self
    {
        $this->lateralidad = $lateralidad;

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
            $antHeredofamiliare->setPacientes($this);
        }

        return $this;
    }

    public function removeAntHeredofamiliare(AntHeredofamiliares $antHeredofamiliare): self
    {
        if ($this->antHeredofamiliares->removeElement($antHeredofamiliare)) {
            // set the owning side to null (unless already changed)
            if ($antHeredofamiliare->getPacientes() === $this) {
                $antHeredofamiliare->setPacientes(null);
            }
        }

        return $this;
    }

    public function getPuestoTrabajo(): ?PuestoTrabajo
    {
        return $this->puesto_trabajo;
    }

    public function setPuestoTrabajo(?PuestoTrabajo $puesto_trabajo): self
    {
        $this->puesto_trabajo = $puesto_trabajo;

        return $this;
    }

    public function getAptitudes(): ?string
    {
        return $this->aptitudes;
    }

    public function setAptitudes(?string $aptitudes): self
    {
        $this->aptitudes = $aptitudes;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

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
            $antQuirugico->setPacientes($this);
        }

        return $this;
    }

    public function removeAntQuirugico(AntQuirugicos $antQuirugico): self
    {
        if ($this->antQuirugicos->removeElement($antQuirugico)) {
            // set the owning side to null (unless already changed)
            if ($antQuirugico->getPacientes() === $this) {
                $antQuirugico->setPacientes(null);
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
            $antLaborale->setPacientes($this);
        }

        return $this;
    }

    public function removeAntLaborale(AntLaborales $antLaborale): self
    {
        if ($this->antLaborales->removeElement($antLaborale)) {
            // set the owning side to null (unless already changed)
            if ($antLaborale->getPacientes() === $this) {
                $antLaborale->setPacientes(null);
            }
        }

        return $this;
    }

  

  


    
}
