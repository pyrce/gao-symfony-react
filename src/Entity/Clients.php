<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"attribution", "searchClient", "clientinfo", "attrib"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30,name="`nomClient`")
     *  @Groups({"attribution", "searchClient", "clientinfo", "attrib"})
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=30,name="`prenomClient`")
     *  @Groups({"attribution", "searchClient", "clientinfo", "attrib"})
     */
    private $prenomClient;

    /**

   * @ORM\OneToMany(targetEntity=Attributions::class, mappedBy="clients")
   *  @Groups({"attribution", "searchClient", "clientinfo", "attrib"})
     */
    private $attributions;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    /**
     * @return Collection|Attributions[]
     */
    public function getAttributions(): Collection
    {
        return $this->attributions;
    }

    public function addAttribution(Attributions $attribution): self
    {
        if (!$this->attributions->contains($attribution)) {
            $this->attributions[] = $attribution;
            $attribution->setClient($this);
        }

        return $this;
    }

    public function removeAttribution(Attributions $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getClient() === $this) {
                $attribution->setClient(null);
            }
        }

        return $this;
    }
}
