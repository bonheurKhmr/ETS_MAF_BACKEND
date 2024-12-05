<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205123557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ADD content_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6084A0A3ED FOREIGN KEY (content_id) REFERENCES entreprise_content (id)');
        $this->addSql('CREATE INDEX IDX_D19FA6084A0A3ED ON entreprise (content_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6084A0A3ED');
        $this->addSql('DROP INDEX IDX_D19FA6084A0A3ED ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP content_id');
    }
}
