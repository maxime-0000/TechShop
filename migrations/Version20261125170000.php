<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125170000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute des visuels aux quatre nouveaux produits du catalogue.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE produit SET image_url = 'https://uk.jbl.com/dw/image/v2/BFND_PRD/on/demandware.static/-/Sites-masterCatalog_Harman/default/dw98ec93ec/3_JBL_FLIP6_FRONT_BLACK_29509_x2.png?sh=1605&sw=1605' WHERE id = 11");
        $this->addSql("UPDATE produit SET image_url = 'https://youget.pt/190765-large_default/auriculares-apple-airpods-4-white.jpg' WHERE id = 12");
        $this->addSql("UPDATE produit SET image_url = 'https://i5-mx.walmartimages.com/samsmx/images/product-images/img_large/980031501l.jpg' WHERE id = 13");
        $this->addSql("UPDATE produit SET image_url = 'https://www.logitechstore.com.br/media/catalog/product/cache/105e6f420716e0751863c4b81f527d17/c/9/c920.png' WHERE id = 14");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE produit SET image_url = NULL WHERE id BETWEEN 11 AND 14');
    }
}
