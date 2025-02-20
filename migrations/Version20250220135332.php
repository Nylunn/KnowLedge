<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220135332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweatshirt ADD size_s VARCHAR(255) NOT NULL, ADD size_m VARCHAR(255) NOT NULL, ADD size_l VARCHAR(255) NOT NULL, ADD size_xl VARCHAR(255) NOT NULL, CHANGE size size_xs VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweatshirt ADD size VARCHAR(255) NOT NULL, DROP size_xs, DROP size_s, DROP size_m, DROP size_l, DROP size_xl');
    }
}
