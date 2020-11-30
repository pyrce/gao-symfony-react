<?php

namespace App\Entity;

use App\Repository\PostesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostesRepository::class)
 */
class Postes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomPoste;

    /**
     * @ORM\OneToMany(targetEntity=Attributions::class, mappedBy="posteId")
     * 
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

    public function getNomPoste(): ?string
    {
        return $this->nomPoste;
    }

    public function setNomPoste(string $nomPoste): self
    {
        $this->nomPoste = $nomPoste;

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
            $attribution->setPosteId($this);
        }

        return $this;
    }

    public function removeAttribution(Attributions $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getPosteId() === $this) {
                $attribution->setPosteId(null);
            }
        }

        return $this;
    }
}
