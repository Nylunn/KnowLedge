<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505131151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, is_final TINYINT(1) NOT NULL, `order` INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progression (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, chapter_id INT DEFAULT NULL, is_completed TINYINT(1) NOT NULL, INDEX IDX_D5B25073A76ED395 (user_id), INDEX IDX_D5B25073579F4768 (chapter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073A76ED395');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073579F4768');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE progression');
    }
}
