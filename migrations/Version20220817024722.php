<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817024722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE laptop_manufacturer (laptop_id INT NOT NULL, manufacturer_id INT NOT NULL, INDEX IDX_A2CBFBA4D59905E5 (laptop_id), INDEX IDX_A2CBFBA4A23B42D (manufacturer_id), PRIMARY KEY(laptop_id, manufacturer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE laptop_manufacturer ADD CONSTRAINT FK_A2CBFBA4D59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE laptop_manufacturer ADD CONSTRAINT FK_A2CBFBA4A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE laptop ADD category_id INT DEFAULT NULL, ADD origin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B56A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('CREATE INDEX IDX_E001563B12469DE2 ON laptop (category_id)');
        $this->addSql('CREATE INDEX IDX_E001563B56A273CC ON laptop (origin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE laptop_manufacturer DROP FOREIGN KEY FK_A2CBFBA4D59905E5');
        $this->addSql('ALTER TABLE laptop_manufacturer DROP FOREIGN KEY FK_A2CBFBA4A23B42D');
        $this->addSql('DROP TABLE laptop_manufacturer');
        $this->addSql('ALTER TABLE laptop DROP FOREIGN KEY FK_E001563B12469DE2');
        $this->addSql('ALTER TABLE laptop DROP FOREIGN KEY FK_E001563B56A273CC');
        $this->addSql('DROP INDEX IDX_E001563B12469DE2 ON laptop');
        $this->addSql('DROP INDEX IDX_E001563B56A273CC ON laptop');
        $this->addSql('ALTER TABLE laptop DROP category_id, DROP origin_id');
    }
}
