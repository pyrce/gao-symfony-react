<?php

namespace App\Entity;

use App\Repository\PostesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use DateTime;
/**
 * @ORM\Entity(repositoryClass=PostesRepository::class)
 */
class Postes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",name="`id`")
     * @Groups("attribution")
     */
    private $id;
    private $jour;
    /**
     * @ORM\Column(type="string", length=255,name="nomPoste")
     * @Groups("attribution")
     */
    private $nomPoste;

    /**
     * @ORM\OneToMany(targetEntity=Attributions::class, mappedBy="poste")
     * @Groups("attribution")
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
     * @return Collection|Assign[]
     */
    public function getAttributions(): Collection
    {
        $date = self::$jour;
        return $this->assigns->filter(function($attr) use($date) {
            $chosenDate =  new DateTime($date);
            return $attr->getJour() == $chosenDate;
        });
    }

    public function addattribution(Attributions $attribution): self
    {
        if (!$this->attributions->contains($attribution)) {
            $this->attributions[] = $attribution;
            $attribution->setPoste($this);
        }

        return $this;
    }

    public function removeAssign(Attributions $assign): self
    {
        if ($this->assigns->removeElement($assign)) {
            // set the owning side to null (unless already changed)
            if ($assign->getPoste() === $this) {
                $assign->setPoste(null);
            }
        }

        return $this;
    }
}
