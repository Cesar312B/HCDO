<?php

namespace App\Entity;

use App\Repository\EcografiasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcografiasRepository::class)
 */
class Ecografias
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
    private $ecografia = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcografia(): ?array
    {
        return $this->ecografia;
    }

    public function setEcografia(?array $ecografia): self
    {
        $this->ecografia = $ecografia;

        return $this;
    }
}
