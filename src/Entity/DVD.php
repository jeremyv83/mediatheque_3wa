<?php

namespace App\Entity;

use App\Repository\DVDRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DVDRepository::class)
 */
class DVD extends Document
{

}
