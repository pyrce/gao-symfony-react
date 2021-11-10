<?php

namespace App\Entity;

use App\Repository\AttributionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=AttributionsRepository::class)
 */
class Attributions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"attribution", "clientinfo", "attrib"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Postes::class, inversedBy="attributions")
     */
    private $poste;
    /**
     * @ORM\Column(type="integer")
     * @Groups({"attribution", "clientinfo", "attrib"})
     */
    private $heure;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="attributions")
     * @Groups({"attribution", "clientinfo", "attrib"})
     */
    private $clients;
    /**
     * @ORM\Column(type="date", length=30)
     * @Groups({"attribution", "clientinfo", "attrib"})
     */
    private $jour;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getClient(): ?int
    {
        return $this->clients;
    }
    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }
    public function getPoste(): ?Postes
    {
        return $this->poste;
    }

    public function setPoste(?Postes $poste): self
    {
        $this->poste = $poste;
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
