<?php

namespace App\Entity;

use App\Repository\CDRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CDRepository::class)
 */
class CD extends Document
{

}
