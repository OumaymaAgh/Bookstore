<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, inversedBy="genres")
     */
    private $Livres;

    public function __construct()
    {
        $this->Livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->Livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->Livres->contains($livre)) {
            $this->Livres[] = $livre;
        }
        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        $this->Livres->removeElement($livre);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
