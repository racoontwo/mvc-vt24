<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240727151505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forestry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, hansynskravande_biotoper INTEGER NOT NULL, skyddszoner INTEGER NOT NULL, upplevelsevarden INTEGER NOT NULL, transport_over_vattendrag INTEGER NOT NULL, kulturmiljoer INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE indicator (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, value INTEGER NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE forestry');
        $this->addSql('DROP TABLE indicator');
    }
}
