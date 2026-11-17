<?php

namespace App\Entity;

use App\Repository\ResponsableEntrepotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsableEntrepotRepository::class)]
class ResponsableEntrepot extends Utilisateurs
{
}