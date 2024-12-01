<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201162137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu ADD type_id INT DEFAULT NULL, ADD orders INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93C54C8C93 FOREIGN KEY (type_id) REFERENCES menu_type (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93C54C8C93 ON menu (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93C54C8C93');
        $this->addSql('DROP TABLE menu_type');
        $this->addSql('DROP INDEX IDX_7D053A93C54C8C93 ON menu');
        $this->addSql('ALTER TABLE menu DROP type_id, DROP orders');
    }
}
