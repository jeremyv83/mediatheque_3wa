<?php

namespace App\Entity;

use App\Repository\LibrarianRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibrarianRepository::class)
 */
class Librarian extends User
{

}
