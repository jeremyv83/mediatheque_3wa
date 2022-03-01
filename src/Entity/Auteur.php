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
     * @ORM\ManyToMany(targetEntity=Rencontre::class, inversedBy="auteurs")
     */
    private $participe_a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->wrote_books = new ArrayCollection();
        $this->participe_a = new ArrayCollection();
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

    /**
     * @return Collection<int, Rencontre>
     */
    public function getParticipeA(): Collection
    {
        return $this->participe_a;
    }

    public function addParticipeA(Rencontre $participeA): self
    {
        if (!$this->participe_a->contains($participeA)) {
            $this->participe_a[] = $participeA;
        }

        return $this;
    }

    public function removeParticipeA(Rencontre $participeA): self
    {
        $this->participe_a->removeElement($participeA);

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
}
