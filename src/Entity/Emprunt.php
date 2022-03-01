<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_emprunt;

    /**
     * @ORM\Column(type="date")
     */
    private $date_remise;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat_remise;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emprunts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $date_emprunt): self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

    public function getDateRemise(): ?\DateTimeInterface
    {
        return $this->date_remise;
    }

    public function setDateRemise(\DateTimeInterface $date_remise): self
    {
        $this->date_remise = $date_remise;

        return $this;
    }

    public function getEtatRemise(): ?int
    {
        return $this->etat_remise;
    }

    public function setEtatRemise(int $etat_remise): self
    {
        $this->etat_remise = $etat_remise;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
