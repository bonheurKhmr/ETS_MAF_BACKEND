<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211114104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, icon LONGTEXT DEFAULT NULL, label VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, content_id INT DEFAULT NULL, logo LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', activated TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, litle_name VARCHAR(255) NOT NULL, rccm VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, province VARCHAR(255) NOT NULL, vile VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, avenue VARCHAR(255) NOT NULL, INDEX IDX_D19FA6084A0A3ED (content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_content (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, description LONGTEXT NOT NULL, title VARCHAR(100) NOT NULL, svg LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4621831AA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, icon LONGTEXT DEFAULT NULL, is_activated TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', orders INT NOT NULL, label VARCHAR(100) NOT NULL, link VARCHAR(100) DEFAULT NULL, lucide_icon VARCHAR(255) DEFAULT NULL, INDEX IDX_7D053A93C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_sous_menu (id INT AUTO_INCREMENT NOT NULL, sous_menu_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_EA4803EBEFDE915F (sous_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sercive_files (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, type VARCHAR(100) DEFAULT NULL, INDEX IDX_5A9BD85DED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, service VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_activated TINYINT(1) NOT NULL, INDEX IDX_E19D9AD293CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_activated TINYINT(1) NOT NULL, direction VARCHAR(10) NOT NULL, see_more TINYINT(1) NOT NULL, orders INT NOT NULL, icon LONGTEXT DEFAULT NULL, INDEX IDX_F30864DFCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_menu_images (id INT AUTO_INCREMENT NOT NULL, sous_menu_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_73619581EFDE915F (sous_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6084A0A3ED FOREIGN KEY (content_id) REFERENCES entreprise_content (id)');
        $this->addSql('ALTER TABLE entreprise_content ADD CONSTRAINT FK_4621831AA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93C54C8C93 FOREIGN KEY (type_id) REFERENCES menu_type (id)');
        $this->addSql('ALTER TABLE menu_sous_menu ADD CONSTRAINT FK_EA4803EBEFDE915F FOREIGN KEY (sous_menu_id) REFERENCES sous_menu (id)');
        $this->addSql('ALTER TABLE sercive_files ADD CONSTRAINT FK_5A9BD85DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD293CB796C FOREIGN KEY (file_id) REFERENCES sercive_files (id)');
        $this->addSql('ALTER TABLE sous_menu ADD CONSTRAINT FK_F30864DFCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE sous_menu_images ADD CONSTRAINT FK_73619581EFDE915F FOREIGN KEY (sous_menu_id) REFERENCES sous_menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6084A0A3ED');
        $this->addSql('ALTER TABLE entreprise_content DROP FOREIGN KEY FK_4621831AA4AEAFEA');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93C54C8C93');
        $this->addSql('ALTER TABLE menu_sous_menu DROP FOREIGN KEY FK_EA4803EBEFDE915F');
        $this->addSql('ALTER TABLE sercive_files DROP FOREIGN KEY FK_5A9BD85DED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD293CB796C');
        $this->addSql('ALTER TABLE sous_menu DROP FOREIGN KEY FK_F30864DFCCD7E912');
        $this->addSql('ALTER TABLE sous_menu_images DROP FOREIGN KEY FK_73619581EFDE915F');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_content');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_sous_menu');
        $this->addSql('DROP TABLE menu_type');
        $this->addSql('DROP TABLE sercive_files');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE sous_menu');
        $this->addSql('DROP TABLE sous_menu_images');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
