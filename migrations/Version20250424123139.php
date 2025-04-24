<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424123139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE initiation ADD formation_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE initiation ADD CONSTRAINT FK_EDC7AE6E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_EDC7AE6E5200282E ON initiation (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE initiation DROP FOREIGN KEY FK_EDC7AE6E5200282E');
        $this->addSql('DROP INDEX IDX_EDC7AE6E5200282E ON initiation');
        $this->addSql('ALTER TABLE initiation DROP formation_id, DROP created_at, DROP updated_at, DROP image');
    }
}
