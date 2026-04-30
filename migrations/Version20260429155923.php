<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260429155923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, rue VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, ville_id INT DEFAULT NULL, INDEX IDX_2F577D59A73F0036 (ville_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE sortie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, date_heure_debut DATETIME NOT NULL, duree INT NOT NULL, date_limite_inscription DATETIME NOT NULL, nb_inscription_max INT NOT NULL, infos_sortie VARCHAR(255) DEFAULT NULL, etat_id INT DEFAULT NULL, lieu_id INT DEFAULT NULL, campus_id INT DEFAULT NULL, organisateur_id INT NOT NULL, INDEX IDX_3C3FD3F2D5E86FF (etat_id), INDEX IDX_3C3FD3F26AB213CC (lieu_id), INDEX IDX_3C3FD3F2AF5D55E1 (campus_id), INDEX IDX_3C3FD3F2D936B2FA (organisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, pseudo VARCHAR(100) NOT NULL, num_tel VARCHAR(20) DEFAULT NULL, actif TINYINT NOT NULL, campus_id INT DEFAULT NULL, INDEX IDX_8D93D649AF5D55E1 (campus_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email, pseudo), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_sortie (user_id INT NOT NULL, sortie_id INT NOT NULL, INDEX IDX_596DC8CFA76ED395 (user_id), INDEX IDX_596DC8CFCC72D953 (sortie_id), PRIMARY KEY (user_id, sortie_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_postal VARCHAR(15) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F26AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2D936B2FA FOREIGN KEY (organisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE user_sortie ADD CONSTRAINT FK_596DC8CFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sortie ADD CONSTRAINT FK_596DC8CFCC72D953 FOREIGN KEY (sortie_id) REFERENCES sortie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59A73F0036');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2D5E86FF');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F26AB213CC');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2AF5D55E1');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2D936B2FA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AF5D55E1');
        $this->addSql('ALTER TABLE user_sortie DROP FOREIGN KEY FK_596DC8CFA76ED395');
        $this->addSql('ALTER TABLE user_sortie DROP FOREIGN KEY FK_596DC8CFCC72D953');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_sortie');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
