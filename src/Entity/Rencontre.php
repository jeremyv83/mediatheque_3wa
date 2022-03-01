<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RencontreRepository::class)
 */
class Rencontre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, mappedBy="participe_a")
     */
    private $auteurs;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="rencontres")
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity=Document::class, inversedBy="rencontres")
     */
    private $linked_documents;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->linked_documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
            $auteur->addParticipeA($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        if ($this->auteurs->removeElement($auteur)) {
            $auteur->removeParticipeA($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getLinkedDocuments(): Collection
    {
        return $this->linked_documents;
    }

    public function addLinkedDocument(Document $linkedDocument): self
    {
        if (!$this->linked_documents->contains($linkedDocument)) {
            $this->linked_documents[] = $linkedDocument;
        }

        return $this;
    }

    public function removeLinkedDocument(Document $linkedDocument): self
    {
        $this->linked_documents->removeElement($linkedDocument);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
