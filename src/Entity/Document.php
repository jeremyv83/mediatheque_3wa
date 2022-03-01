<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="wrote_books")
     */
    private $auteur;

    /**
     * @ORM\ManyToMany(targetEntity=Rencontre::class, mappedBy="linked_documents")
     */
    private $rencontres;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="comment")
     */
    private $commented_by;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="emprunt")
     */
    private $emprunted_by;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="reserved")
     */
    private $reserved_by;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="recommandation")
     */
    private $recommanded_by;

    /**
     * @ORM\ManyToOne(targetEntity=DocumentType::class, inversedBy="documents")
     */
    private $documentType;

    /**
     * @ORM\OneToMany(targetEntity=Logs::class, mappedBy="documents")
     */
    private $logs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $physique;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fragile;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="document")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Emprunt::class, mappedBy="document")
     */
    private $emprunts;

    public function __construct()
    {
        $this->rencontres = new ArrayCollection();
        $this->commented_by = new ArrayCollection();
        $this->emprunted_by = new ArrayCollection();
        $this->reserved_by = new ArrayCollection();
        $this->recommanded_by = new ArrayCollection();
        $this->logs = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

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
            $rencontre->addLinkedDocument($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): self
    {
        if ($this->rencontres->removeElement($rencontre)) {
            $rencontre->removeLinkedDocument($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getCommentedBy(): Collection
    {
        return $this->commented_by;
    }

    public function addCommentedBy(User $commentedBy): self
    {
        if (!$this->commented_by->contains($commentedBy)) {
            $this->commented_by[] = $commentedBy;
            $commentedBy->addComment($this);
        }

        return $this;
    }

    public function removeCommentedBy(User $commentedBy): self
    {
        if ($this->commented_by->removeElement($commentedBy)) {
            $commentedBy->removeComment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getEmpruntedBy(): Collection
    {
        return $this->emprunted_by;
    }

    public function addEmpruntedBy(User $empruntedBy): self
    {
        if (!$this->emprunted_by->contains($empruntedBy)) {
            $this->emprunted_by[] = $empruntedBy;
            $empruntedBy->addEmprunt($this);
        }

        return $this;
    }

    public function removeEmpruntedBy(User $empruntedBy): self
    {
        if ($this->emprunted_by->removeElement($empruntedBy)) {
            $empruntedBy->removeEmprunt($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getReservedBy(): Collection
    {
        return $this->reserved_by;
    }

    public function addReservedBy(User $reservedBy): self
    {
        if (!$this->reserved_by->contains($reservedBy)) {
            $this->reserved_by[] = $reservedBy;
            $reservedBy->addReserved($this);
        }

        return $this;
    }

    public function removeReservedBy(User $reservedBy): self
    {
        if ($this->reserved_by->removeElement($reservedBy)) {
            $reservedBy->removeReserved($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRecommandedBy(): Collection
    {
        return $this->recommanded_by;
    }

    public function addRecommandedBy(User $recommandedBy): self
    {
        if (!$this->recommanded_by->contains($recommandedBy)) {
            $this->recommanded_by[] = $recommandedBy;
            $recommandedBy->addRecommandation($this);
        }

        return $this;
    }

    public function removeRecommandedBy(User $recommandedBy): self
    {
        if ($this->recommanded_by->removeElement($recommandedBy)) {
            $recommandedBy->removeRecommandation($this);
        }

        return $this;
    }

    public function getDocumentType(): ?DocumentType
    {
        return $this->documentType;
    }

    public function setDocumentType(?DocumentType $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * @return Collection<int, Logs>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Logs $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setDocuments($this);
        }

        return $this;
    }

    public function removeLog(Logs $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getDocuments() === $this) {
                $log->setDocuments(null);
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPhysique(): ?bool
    {
        return $this->physique;
    }

    public function setPhysique(bool $physique): self
    {
        $this->physique = $physique;

        return $this;
    }

    public function getFragile(): ?bool
    {
        return $this->fragile;
    }

    public function setFragile(bool $fragile): self
    {
        $this->fragile = $fragile;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setDocument($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getDocument() === $this) {
                $comment->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): self
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts[] = $emprunt;
            $emprunt->setDocument($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): self
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getDocument() === $this) {
                $emprunt->setDocument(null);
            }
        }

        return $this;
    }
}
