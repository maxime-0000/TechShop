<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261117155650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE charge_entrepot (id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE responsable_entrepot (id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE responsable_marketing (id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type_produit (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type_utilisateur VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE charge_entrepot ADD CONSTRAINT FK_7EEDABC9BF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_entrepot ADD CONSTRAINT FK_FCAD7B40BF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_marketing ADD CONSTRAINT FK_69C7307EBF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge_entrepot DROP FOREIGN KEY FK_7EEDABC9BF396750');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE responsable_entrepot DROP FOREIGN KEY FK_FCAD7B40BF396750');
        $this->addSql('ALTER TABLE responsable_marketing DROP FOREIGN KEY FK_69C7307EBF396750');
        $this->addSql('DROP TABLE charge_entrepot');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE responsable_entrepot');
        $this->addSql('DROP TABLE responsable_marketing');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE type_produit');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
