<?php

namespace App\Entity;

use App\Repository\EmployedRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=EmployedRepository::class)
 * @UniqueEntity(fields={"Cedula", "email"}, message="La cédula o correo ya existen.")
 */
class Employed implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;




    
     /**
     * @ORM\Column(type="string", length=10,unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     * )
     */
    private $Cedula;


    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es valido."
     * )
     */
    private $email;

   

    /**
     * @ORM\Column(type="string", length=255, )
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;




    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Range(
     *      max = "now"
     * )
     */
    private $Fecha_Ingreso;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Profesion;

    
     /**
     * @ORM\Column(type="string", length=64)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Unidadesoperativas::class, inversedBy="employed")
     * @ORM\JoinColumn(nullable=true)
     */
    private $unidadesoperativas;

    /**
     * @ORM\OneToMany(targetEntity=Consulta::class, mappedBy="employed", orphanRemoval=true)
     */
    private $consulta;



    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;


     /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    

    public function __construct()
    {
      
      
        $this->is_active = true;
        $this->Fecha_Ingreso= new \DateTime();
        $this->consulta = new ArrayCollection();
       
      
      
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->Cedula;
    }

    public function setCedula(string $Cedula): self
    {
        $this->Cedula = $Cedula;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(string $Apellido): self
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }


    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->Fecha_Ingreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $Fecha_Ingreso): self
    {
        $this->Fecha_Ingreso = $Fecha_Ingreso;

        return $this;
    }

  
    public function getProfesion(): ?string
    {
        return $this->Profesion;
    }

    public function setProfesion(string $Profesion): self
    {
        $this->Profesion = $Profesion;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUnidadesoperativas(): ?Unidadesoperativas
    {
        return $this->unidadesoperativas;
    }

    public function setUnidadesoperativas(?Unidadesoperativas $unidadesoperativas): self
    {
        $this->unidadesoperativas = $unidadesoperativas;

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
            $consultum->setEmployed($this);
        }

        return $this;
    }

    public function removeConsultum(Consulta $consultum): self
    {
        if ($this->consulta->removeElement($consultum)) {
            // set the owning side to null (unless already changed)
            if ($consultum->getEmployed() === $this) {
                $consultum->setEmployed(null);
            }
        }

        return $this;
    }

}
