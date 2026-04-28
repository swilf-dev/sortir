<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260428082911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sortie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, date_heure_debut DATETIME NOT NULL, duree INT NOT NULL, date_limite_inscription DATETIME NOT NULL, nb_inscription_max INT NOT NULL, infos_sortie VARCHAR(255) DEFAULT NULL, etat INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B386CC499D ON utilisateur (pseudo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sortie');
        $this->addSql('DROP INDEX UNIQ_1D1C63B386CC499D ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur');
    }
}
