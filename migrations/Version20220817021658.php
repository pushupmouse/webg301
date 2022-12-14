<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817021658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE laptop ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_E001563B44F5D008 ON laptop (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE laptop DROP FOREIGN KEY FK_E001563B44F5D008');
        $this->addSql('DROP INDEX IDX_E001563B44F5D008 ON laptop');
        $this->addSql('ALTER TABLE laptop DROP brand_id');
    }
}
