<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125160000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute quatre produits complémentaires au catalogue.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO produit (nom, quantite, description, image_url, prix) VALUES ('JBL Flip 6', 18, 'Enceinte Bluetooth portable conçue pour écouter de la musique à la maison et en déplacement.', NULL, 128.99)");
        $this->addSql("INSERT INTO produit (nom, quantite, description, image_url, prix) VALUES ('Apple AirPods 4', 25, 'Écouteurs sans fil avec boîtier de recharge USB-C pour écouter de la musique et passer des appels.', NULL, 129.00)");
        $this->addSql("INSERT INTO produit (nom, quantite, description, image_url, prix) VALUES ('Nintendo Switch OLED', 7, 'Console hybride avec écran OLED, utilisable en mode portable ou sur téléviseur.', NULL, 299.99)");
        $this->addSql("INSERT INTO produit (nom, quantite, description, image_url, prix) VALUES ('Logitech C920 HD Pro', 11, 'Webcam Full HD 1080p adaptée aux visioconférences, aux cours en ligne et au streaming.', NULL, 59.49)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM produit WHERE nom IN ('JBL Flip 6', 'Apple AirPods 4', 'Nintendo Switch OLED', 'Logitech C920 HD Pro')");
    }
}
