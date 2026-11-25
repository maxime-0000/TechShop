<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute une image distante aux produits du catalogue.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE produit ADD image_url VARCHAR(2048) DEFAULT NULL');
        $this->addSql("UPDATE produit SET image_url = 'https://www.dateks.lv/images/pic/2400/2400/039/2251.jpg' WHERE id = 1");
        $this->addSql("UPDATE produit SET image_url = 'https://cdn.beebom.com/mobile/2024/01/Untitled-design-31-4.png' WHERE id = 2");
        $this->addSql("UPDATE produit SET image_url = 'https://www.custommacbd.com/cdn/shop/files/mba13-m3-spacegray-Custom-Mac-BD.png?v=1711705803' WHERE id = 3");
        $this->addSql("UPDATE produit SET image_url = 'https://dlcdnwebimgs.asus.com/files/media/9298035B-F636-4CAF-AC96-C5EE7A461273/pd-front.png' WHERE id = 4");
        $this->addSql("UPDATE produit SET image_url = 'https://cdn.uniquephoto.com/resources/uniquephoto/images/products/processed/SYCD3506.detail.a.png' WHERE id = 5");
        $this->addSql("UPDATE produit SET image_url = 'https://www.pixelzones.com/cdn/shop/files/Logitech_G502_Hero_Gaming_Mouse.jpg?v=1744804538&width=1946' WHERE id = 6");
        $this->addSql("UPDATE produit SET image_url = 'https://f.fcdn.app/imgs/88409e/www.zonatecno.com.uy/zoteuy/3a97/original/catalogo/107480_107480_1/1500-1500/monitor-gamer-samsung-odyssey-g5-g55c-27-qhd-1-ms-165-hz-monitor-gamer-samsung-odyssey-g5-g55c-27-qhd-1-ms-165-hz.jpg' WHERE id = 7");
        $this->addSql("UPDATE produit SET image_url = 'https://media.tatacroma.com/Croma%20Assets/Computers%20Peripherals/Tablets%20and%20iPads/Images/301947_0_tp6rrd.png' WHERE id = 8");
        $this->addSql("UPDATE produit SET image_url = 'https://cdn11.bigcommerce.com/s-ms4wz8cgi2/images/stencil/590x590/products/98346/23928/SSDSAM990P4T__53016.1701906751.jpg?c=1' WHERE id = 9");
        $this->addSql("UPDATE produit SET image_url = 'https://images.pcel.com/1600/Accesorios-Teclados-Corsair-CH-910941A-NA-507844-n4L9QvNuZ3HW979S.jpg' WHERE id = 10");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE produit DROP image_url');
    }
}
