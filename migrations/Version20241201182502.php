<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201182502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sercive_files (id INT AUTO_INCREMENT NOT NULL, file VARCHAR(255) DEFAULT NULL, type VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD293CB796C FOREIGN KEY (file_id) REFERENCES sercive_files (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD293CB796C ON service (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD293CB796C');
        $this->addSql('DROP TABLE sercive_files');
        $this->addSql('DROP INDEX IDX_E19D9AD293CB796C ON service');
        $this->addSql('ALTER TABLE service DROP file_id');
    }
}
