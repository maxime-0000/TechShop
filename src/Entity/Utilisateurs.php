<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type_utilisateur', type: 'string')]
#[ORM\DiscriminatorMap([
    'utilisateur' => Utilisateurs::class,
    'client' => Client::class,
    'marketing' => ResponsableMarketing::class,
    'charge_entrepot' => ChargeEntrepot::class,
    'responsable_entrepot' => ResponsableEntrepot::class
])]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}