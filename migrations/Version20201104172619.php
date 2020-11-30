<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104172619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attributions (id INT AUTO_INCREMENT NOT NULL, clientId INT DEFAULT NULL, posteId INT DEFAULT NULL, heure INT NOT NULL, jour VARCHAR(30) NOT NULL, INDEX IDX_14C967D2DC2902E0 (clientId), INDEX IDX_14C967D2C94D6CB2 (posteId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(30) NOT NULL, prenom_client VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postes (id INT AUTO_INCREMENT NOT NULL, nom_poste VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(30) NOT NULL, motdepasse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2DC2902E0 FOREIGN KEY (clientId) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE attributions ADD CONSTRAINT FK_14C967D2C94D6CB2 FOREIGN KEY (posteId) REFERENCES postes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2DC2902E0');
        $this->addSql('ALTER TABLE attributions DROP FOREIGN KEY FK_14C967D2C94D6CB2');
        $this->addSql('DROP TABLE attributions');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE postes');
        $this->addSql('DROP TABLE users');
    }
}
