<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127142559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__person AS SELECT id, building_id, name, email FROM person');
        $this->addSql('DROP TABLE person');
        $this->addSql('CREATE TABLE person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER DEFAULT NULL, residents_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_34DCD1764D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_34DCD1762C901C6C FOREIGN KEY (residents_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO person (id, building_id, name, email) SELECT id, building_id, name, email FROM __temp__person');
        $this->addSql('DROP TABLE __temp__person');
        $this->addSql('CREATE INDEX IDX_34DCD1764D2A7E12 ON person (building_id)');
        $this->addSql('CREATE INDEX IDX_34DCD1762C901C6C ON person (residents_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__person AS SELECT id, building_id, name, email FROM person');
        $this->addSql('DROP TABLE person');
        $this->addSql('CREATE TABLE person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_34DCD1764D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO person (id, building_id, name, email) SELECT id, building_id, name, email FROM __temp__person');
        $this->addSql('DROP TABLE __temp__person');
        $this->addSql('CREATE INDEX IDX_34DCD1764D2A7E12 ON person (building_id)');
    }
}
