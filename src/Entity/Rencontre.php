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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="rencontres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Auteur;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->linked_documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->Auteur;
    }

    public function setAuteur(?Auteur $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }
}
