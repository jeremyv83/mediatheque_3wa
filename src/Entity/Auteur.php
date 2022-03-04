<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuteurRepository::class)
 */
class Auteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="auteur")
     */
    private $wrote_books;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Rencontre::class, mappedBy="Auteur")
     */
    private $rencontres;

    public function __construct()
    {
        $this->wrote_books = new ArrayCollection();
        $this->participe_a = new ArrayCollection();
        $this->rencontres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getWroteBooks(): Collection
    {
        return $this->wrote_books;
    }

    public function addWroteBook(Document $wroteBook): self
    {
        if (!$this->wrote_books->contains($wroteBook)) {
            $this->wrote_books[] = $wroteBook;
            $wroteBook->setAuteur($this);
        }

        return $this;
    }

    public function removeWroteBook(Document $wroteBook): self
    {
        if ($this->wrote_books->removeElement($wroteBook)) {
            // set the owning side to null (unless already changed)
            if ($wroteBook->getAuteur() === $this) {
                $wroteBook->setAuteur(null);
            }
        }

        return $this;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontres(): Collection
    {
        return $this->rencontres;
    }

    public function addRencontre(Rencontre $rencontre): self
    {
        if (!$this->rencontres->contains($rencontre)) {
            $this->rencontres[] = $rencontre;
            $rencontre->setAuteur($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): self
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getAuteur() === $this) {
                $rencontre->setAuteur(null);
            }
        }

        return $this;
    }
}
