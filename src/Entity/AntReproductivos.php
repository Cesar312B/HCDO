<?php

namespace App\Entity;

use App\Repository\AntReproductivosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AntReproductivosRepository::class)
 */
class AntReproductivos
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
    private $menarquia;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ciclos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gestas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abortos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hijos;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $vida_sexual;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $ultima_mastografia;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_mastografia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_mastografia;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $colposcopia;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_colposcopia;

 

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_colposcopia;

    


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metodo_planificacion;

  

    /**
     * @ORM\ManyToOne(targetEntity=Pacientes::class, inversedBy="antReproductivos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pacientes;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Range(
     *      max = "now"
     * )
     */
    private $ultima_menstruacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cesareas;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $papanicolaou;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_papanicolaou;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_papanicolaou;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $eco_mamario;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_ecomamario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_ecomamario;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $antigeno_prostatico;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_antigenoprostatico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_antigenoprostatico;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $eco_prostatico;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiempo_ecoprostatico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultado_ecoprostatico;

    /**
     * @ORM\ManyToOne(targetEntity=Consulta::class, inversedBy="antReproductivos")
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

    public function getMenarquia(): ?int
    {
        return $this->menarquia;
    }

    public function setMenarquia(?int $menarquia): self
    {
        $this->menarquia = $menarquia;

        return $this;
    }

    public function getCiclos(): ?string
    {
        return $this->ciclos;
    }

    public function setCiclos(?string $ciclos): self
    {
        $this->ciclos = $ciclos;

        return $this;
    }

    public function getGestas(): ?int
    {
        return $this->gestas;
    }

    public function setGestas(?int $gestas): self
    {
        $this->gestas = $gestas;

        return $this;
    }

    public function getPartos(): ?int
    {
        return $this->partos;
    }

    public function setPartos(?int $partos): self
    {
        $this->partos = $partos;

        return $this;
    }

    public function getAbortos(): ?int
    {
        return $this->abortos;
    }

    public function setAbortos(?int $abortos): self
    {
        $this->abortos = $abortos;

        return $this;
    }

    public function getHijos(): ?int
    {
        return $this->hijos;
    }

    public function setHijos(?int $hijos): self
    {
        $this->hijos = $hijos;

        return $this;
    }

    public function getVidaSexual(): ?string
    {
        return $this->vida_sexual;
    }

    public function setVidaSexual(?string $vida_sexual): self
    {
        $this->vida_sexual = $vida_sexual;

        return $this;
    }

    public function getUltimaMastografia(): ?string
    {
        return $this->ultima_mastografia;
    }

    public function setUltimaMastografia(?string $ultima_mastografia): self
    {
        $this->ultima_mastografia = $ultima_mastografia;

        return $this;
    }

   

    public function getResultadoColposcopia(): ?string
    {
        return $this->resultado_colposcopia;
    }

    public function setResultadoColposcopia(?string $resultado_colposcopia): self
    {
        $this->resultado_colposcopia = strtoupper($resultado_colposcopia) ;

        return $this;
    }


    public function getMetodoPlanificacion(): ?string
    {
        return $this->metodo_planificacion;
    }

    public function setMetodoPlanificacion(?string $metodo_planificacion): self
    {
        $this->metodo_planificacion = strtoupper ($metodo_planificacion);

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

    public function getUltimaMenstruacion(): ?\DateTimeInterface
    {
        return $this->ultima_menstruacion;
    }

    public function setUltimaMenstruacion(?\DateTimeInterface $ultima_menstruacion): self
    {
        $this->ultima_menstruacion = $ultima_menstruacion;

        return $this;
    }

    public function getCesareas(): ?int
    {
        return $this->cesareas;
    }

    public function setCesareas(?int $cesareas): self
    {
        $this->cesareas = $cesareas;

        return $this;
    }

    public function getPapanicolaou(): ?string
    {
        return $this->papanicolaou;
    }

    public function setPapanicolaou(?string $papanicolaou): self
    {
        $this->papanicolaou = $papanicolaou;

        return $this;
    }

    public function getTiempoPapanicolaou(): ?int
    {
        return $this->tiempo_papanicolaou;
    }

    public function setTiempoPapanicolaou(?int $tiempo_papanicolaou): self
    {
        $this->tiempo_papanicolaou = $tiempo_papanicolaou;

        return $this;
    }

    public function getResultadoPapanicolaou(): ?string
    {
        return $this->resultado_papanicolaou;
    }

    public function setResultadoPapanicolaou(?string $resultado_papanicolaou): self
    {
        $this->resultado_papanicolaou = strtoupper($resultado_papanicolaou);

        return $this;
    }

    public function getEcoMamario(): ?string
    {
        return $this->eco_mamario;
    }

    public function setEcoMamario(?string $eco_mamario): self
    {
        $this->eco_mamario = $eco_mamario;

        return $this;
    }

    public function getTiempoEcomamario(): ?int
    {
        return $this->tiempo_ecomamario;
    }

    public function setTiempoEcomamario(?int $tiempo_ecomamario): self
    {
        $this->tiempo_ecomamario = strtoupper($tiempo_ecomamario);

        return $this;
    }

    public function getResultadoEcomamario(): ?string
    {
        return $this->resultado_ecomamario;
    }

    public function setResultadoEcomamario(?string $resultado_ecomamario): self
    {
        $this->resultado_ecomamario = strtoupper ($resultado_ecomamario);

        return $this;
    }

    public function getAntigenoProstatico(): ?string
    {
        return $this->antigeno_prostatico;
    }

    public function setAntigenoProstatico(?string $antigeno_prostatico): self
    {
        $this->antigeno_prostatico = $antigeno_prostatico;

        return $this;
    }

    public function getTiempoAntigenoprostatico(): ?int
    {
        return $this->tiempo_antigenoprostatico;
    }

    public function setTiempoAntigenoprostatico(?int $tiempo_antigenoprostatico): self
    {
        $this->tiempo_antigenoprostatico = strtoupper($tiempo_antigenoprostatico);

        return $this;
    }

    public function getResultadoAntigenoprostatico(): ?string
    {
        return $this->resultado_antigenoprostatico;
    }

    public function setResultadoAntigenoprostatico(?string $resultado_antigenoprostatico): self
    {
        $this->resultado_antigenoprostatico = strtoupper ($resultado_antigenoprostatico);

        return $this;
    }

    public function getEcoProstatico(): ?string
    {
        return $this->eco_prostatico;
    }

    public function setEcoProstatico(?string $eco_prostatico): self
    {
        $this->eco_prostatico = $eco_prostatico;

        return $this;
    }

    public function getTiempoEcoprostatico(): ?int
    {
        return $this->tiempo_ecoprostatico;
    }

    public function setTiempoEcoprostatico(?int $tiempo_ecoprostatico): self
    {
        $this->tiempo_ecoprostatico = $tiempo_ecoprostatico;

        return $this;
    }

    public function getResultadoEcoprostatico(): ?string
    {
        return $this->resultado_ecoprostatico;
    }

    public function setResultadoEcoprostatico(?string $resultado_ecoprostatico): self
    {
        $this->resultado_ecoprostatico = strtoupper($resultado_ecoprostatico);

        return $this;
    }

    public function getColposcopia(): ?string
    {
        return $this->colposcopia;
    }

    public function setColposcopia(?string $colposcopia): self
    {
        $this->colposcopia = $colposcopia;

        return $this;
    }

    public function getTiempoColposcopia(): ?int
    {
        return $this->tiempo_colposcopia;
    }

    public function setTiempoColposcopia(?int $tiempo_colposcopia): self
    {
        $this->tiempo_colposcopia = strtoupper($tiempo_colposcopia) ;

        return $this;
    }

    public function getTiempoMastografia(): ?int
    {
        return $this->tiempo_mastografia;
    }

    public function setTiempoMastografia(?int $tiempo_mastografia): self
    {
        $this->tiempo_mastografia = strtoupper($tiempo_mastografia);

        return $this;
    }

    public function getResultadoMastografia(): ?string
    {
        return $this->resultado_mastografia;
    }

    public function setResultadoMastografia(?string $resultado_mastografia): self
    {
        $this->resultado_mastografia =  strtoupper($resultado_mastografia);

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
