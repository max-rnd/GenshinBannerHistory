<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112133950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE banner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE character_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE banner (id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE banner_character (banner_id INT NOT NULL, character_id INT NOT NULL, PRIMARY KEY(banner_id, character_id))');
        $this->addSql('CREATE INDEX IDX_311FF888684EC833 ON banner_character (banner_id)');
        $this->addSql('CREATE INDEX IDX_311FF8881136BE75 ON banner_character (character_id)');
        $this->addSql('CREATE TABLE character (id INT NOT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE banner_character ADD CONSTRAINT FK_311FF888684EC833 FOREIGN KEY (banner_id) REFERENCES banner (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE banner_character ADD CONSTRAINT FK_311FF8881136BE75 FOREIGN KEY (character_id) REFERENCES character (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE banner_character DROP CONSTRAINT FK_311FF888684EC833');
        $this->addSql('ALTER TABLE banner_character DROP CONSTRAINT FK_311FF8881136BE75');
        $this->addSql('DROP SEQUENCE banner_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE character_id_seq CASCADE');
        $this->addSql('DROP TABLE banner');
        $this->addSql('DROP TABLE banner_character');
        $this->addSql('DROP TABLE character');
    }
}
