<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125140000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Restaure les descriptions des produits dans la base.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE produit ADD description VARCHAR(1000) DEFAULT '' NOT NULL");
        $this->addSql("UPDATE produit SET description = 'Smartphone polyvalent pour les photos, les vidéos et les applications du quotidien.' WHERE id = 1");
        $this->addSql("UPDATE produit SET description = 'Smartphone pensé pour le quotidien, avec un écran immersif et des fonctions photo polyvalentes.' WHERE id = 2");
        $this->addSql("UPDATE produit SET description = 'Ordinateur portable léger pour travailler, étudier et créer en mobilité.' WHERE id = 3");
        $this->addSql("UPDATE produit SET description = 'PC portable orienté gaming, adapté aux jeux exigeants et aux tâches intensives.' WHERE id = 4");
        $this->addSql("UPDATE produit SET description = 'Casque sans fil à réduction de bruit pour écouter musique, podcasts et appels confortablement.' WHERE id = 5");
        $this->addSql("UPDATE produit SET description = 'Souris gaming avec capteur précis et boutons programmables pour personnaliser les commandes.' WHERE id = 6");
        $this->addSql("UPDATE produit SET description = 'Écran incurvé pour une expérience immersive en jeu, en vidéo et au quotidien.' WHERE id = 7");
        $this->addSql("UPDATE produit SET description = 'Tablette polyvalente pour lire, dessiner, regarder des vidéos et travailler en mobilité.' WHERE id = 8");
        $this->addSql("UPDATE produit SET description = 'SSD interne conçu pour accélérer les transferts, le lancement des applications et le stockage.' WHERE id = 9");
        $this->addSql("UPDATE produit SET description = 'Clavier mécanique avec éclairage RGB, conçu pour le jeu et la saisie réactive.' WHERE id = 10");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE produit DROP description');
    }
}
