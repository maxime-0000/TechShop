<?php

namespace App\Entity;

use App\Repository\ResponsableMarketingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsableMarketingRepository::class)]
class ResponsableMarketing extends Utilisateurs
{
}