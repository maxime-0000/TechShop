<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125130000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute un prix en euros aux produits du catalogue.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE produit ADD prix NUMERIC(10, 2) DEFAULT '0.00' NOT NULL");
        $this->addSql('UPDATE produit SET prix = 729.00 WHERE id = 1');
        $this->addSql('UPDATE produit SET prix = 699.00 WHERE id = 2');
        $this->addSql('UPDATE produit SET prix = 1189.99 WHERE id = 3');
        $this->addSql('UPDATE produit SET prix = 1599.99 WHERE id = 4');
        $this->addSql('UPDATE produit SET prix = 237.99 WHERE id = 5');
        $this->addSql('UPDATE produit SET prix = 39.99 WHERE id = 6');
        $this->addSql('UPDATE produit SET prix = 162.00 WHERE id = 7');
        $this->addSql('UPDATE produit SET prix = 719.00 WHERE id = 8');
        $this->addSql('UPDATE produit SET prix = 234.00 WHERE id = 9');
        $this->addSql('UPDATE produit SET prix = 109.99 WHERE id = 10');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE produit DROP prix');
    }
}
