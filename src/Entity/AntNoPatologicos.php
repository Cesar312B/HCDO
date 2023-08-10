<?php

namespace App\Entity;

use App\Repository\AntNoPatologicosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntNoPatologicosRepository::class)
 */
class AntNoPatologicos
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
    private $actividad_fisica;

     /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $numero_actividad_fisica;


  
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uso_sustancias;


    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $numero_sustancias;

 
    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="antNoPatologicos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $tiempo_consumo;

  
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_abstinencia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $medicacion_abitual;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantdad_medicacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sustancia_selec;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deporte_select;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $medicamento_select;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tabaco;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $exconsumidor;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ex_consumidor;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $tiempo_consumo_a;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidad_a;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $exconsumidor_a;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_abstinencia_a;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $tiempo_consumo_d;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_abstinencia_d;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $droga_descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="antNoPatologicos")
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

    public function getActividadFisica(): ?string
    {
        return $this->actividad_fisica;
    }

    public function setActividadFisica(?string $actividad_fisica): self
    {
        $this->actividad_fisica = strtoupper ($actividad_fisica);

        return $this;
    }

   
    public function getUsoSustancias(): ?string
    {
        return $this->uso_sustancias;
    }

    public function setUsoSustancias(?string $uso_sustancias): self
    {
        $this->uso_sustancias = strtoupper($uso_sustancias);

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

    public function getNumeroActividadFisica(): ?string
    {
        return $this->numero_actividad_fisica;
    }

    public function setNumeroActividadFisica(?string $numero_actividad_fisica): self
    {
        $this->numero_actividad_fisica = strtoupper($numero_actividad_fisica);

        return $this;
    }

    public function getNumeroSustancias(): ?int
    {
        return $this->numero_sustancias;
    }

    public function setNumeroSustancias(?int $numero_sustancias): self
    {
        $this->numero_sustancias = $numero_sustancias;

        return $this;
    }

    public function getTiempoConsumo(): ?string
    {
        return $this->tiempo_consumo;
    }

    public function setTiempoConsumo(?string $tiempo_consumo): self
    {
        $this->tiempo_consumo = strtoupper($tiempo_consumo) ;

        return $this;
    }

    public function getExConsumidor(): ?string
    {
        return $this->exconsumidor;
    }

    public function setExConsumidor(?string $exconsumidor): self
    {
        $this->exconsumidor = strtoupper($exconsumidor);

        return $this;
    }


    public function getTiempoAbstinencia(): ?int
    {
        return $this->tiempo_abstinencia;
    }

    public function setTiempoAbstinencia(?int $tiempo_abstinencia): self
    {
        $this->tiempo_abstinencia = $tiempo_abstinencia;

        return $this;
    }

    public function getMedicacionAbitual(): ?string
    {
        return $this->medicacion_abitual;
    }

    public function setMedicacionAbitual(?string $medicacion_abitual): self
    {
        $this->medicacion_abitual = strtoupper ($medicacion_abitual);

        return $this;
    }

    public function getCantdadMedicacion(): ?int
    {
        return $this->cantdad_medicacion;
    }

    public function setCantdadMedicacion(?int $cantdad_medicacion): self
    {
        $this->cantdad_medicacion = $cantdad_medicacion;

        return $this;
    }

    public function getSustanciaSelec(): ?string
    {
        return $this->sustancia_selec;
    }

    public function setSustanciaSelec(?string $sustancia_selec): self
    {
        $this->sustancia_selec = strtoupper ($sustancia_selec);

        return $this;
    }

    public function getDeporteSelect(): ?string
    {
        return $this->deporte_select;
    }

    public function setDeporteSelect(?string $deporte_select): self
    {
        $this->deporte_select = strtoupper($deporte_select);

        return $this;
    }

    public function getMedicamentoSelect(): ?string
    {
        return $this->medicamento_select;
    }

    public function setMedicamentoSelect(?string $medicamento_select): self
    {
        $this->medicamento_select = strtoupper($medicamento_select);

        return $this;
    }

    public function getTabaco(): ?string
    {
        return $this->tabaco;
    }

    public function setTabaco(?string $tabaco): self
    {
        $this->tabaco = strtoupper($tabaco);

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getTiempoConsumoA(): ?string
    {
        return $this->tiempo_consumo_a;
    }

    public function setTiempoConsumoA(?string $tiempo_consumo_a): self
    {
        $this->tiempo_consumo_a = strtoupper ($tiempo_consumo_a);

        return $this;
    }

    public function getCantidadA(): ?int
    {
        return $this->cantidad_a;
    }

    public function setCantidadA(?int $cantidad_a): self
    {
        $this->cantidad_a = $cantidad_a;

        return $this;
    }

    public function getEx_consumidor(): ?string
    {
        return $this->ex_consumidor;
    }

    public function setEx_consumidor(?string $ex_consumidor): self
    {
        $this->ex_consumidor = strtoupper ($ex_consumidor);

        return $this;
    }



    public function getExconsumidorA(): ?string
    {
        return $this->exconsumidor_a;
    }

    public function setExconsumidorA(?string $exconsumidor_a): self
    {
        $this->exconsumidor_a = strtoupper($exconsumidor_a);

        return $this;
    }


    public function getTiempoAbstinenciaA(): ?int
    {
        return $this->tiempo_abstinencia_a;
    }

    public function setTiempoAbstinenciaA(?int $tiempo_abstinencia_a): self
    {
        $this->tiempo_abstinencia_a = $tiempo_abstinencia_a;

        return $this;
    }

    public function getTiempoConsumoD(): ?string
    {
        return $this->tiempo_consumo_d;
    }

    public function setTiempoConsumoD(?string $tiempo_consumo_d): self
    {
        $this->tiempo_consumo_d = strtoupper($tiempo_consumo_d);

        return $this;
    }

    public function getTiempoAbstinenciaD(): ?int
    {
        return $this->tiempo_abstinencia_d;
    }

    public function setTiempoAbstinenciaD(?int $tiempo_abstinencia_d): self
    {
        $this->tiempo_abstinencia_d = $tiempo_abstinencia_d;

        return $this;
    }

    public function getDrogaDescripcion(): ?string
    {
        return $this->droga_descripcion;
    }

    public function setDrogaDescripcion(?string $droga_descripcion): self
    {
        $this->droga_descripcion = strtoupper($droga_descripcion);

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
