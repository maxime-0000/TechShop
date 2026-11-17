<?php

namespace App\Entity;

use App\Repository\ChargeEntrepotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChargeEntrepotRepository::class)]
class ChargeEntrepot extends Utilisateurs
{
}