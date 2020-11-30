<?php

namespace App\Entity;

use App\Repository\AttributionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributionsRepository::class)
 */
class Attributions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
           *     *@ORM\ManyToOne(targetEntity=Clients::class, inversedBy="attributions")
               *@ORM\JoinTable(name="clients")
    * @ORM\JoinColumn(name="clientId", referencedColumnName="id")

     */
    private $clientId;

    /**
           *     *@ORM\ManyToOne(targetEntity=Postes::class, inversedBy="attributions")
               *@ORM\JoinTable(name="Postes")
    * @ORM\JoinColumn(name="posteId", referencedColumnName="id")
     */
    private $posteId;

    /**
     * @ORM\Column(type="integer")
     */
    private $heure;
    private $clients;
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $jour;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getClients(): ?int
    {
        return $this->clients;
    }
    public function getClientId(): ?Clients
    {
        return $this->clientId;
    }

    public function setClientId(?Clients $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getPosteId(): ?Postes
    {
        return $this->posteId;
    }

    public function setPosteId(?Postes $posteId): self
    {
        $this->posteId = $posteId;

        return $this;
    }

    public function getHeure(): ?int
    {
        return $this->heure;
    }

    public function setHeure(int $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }
}
