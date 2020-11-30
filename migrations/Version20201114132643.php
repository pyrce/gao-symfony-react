<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114132643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON , password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attributions CHANGE heure heure INT , CHANGE jour jour VARCHAR(30)');
        $this->addSql('ALTER TABLE attributions RENAME INDEX idx_14c967d2dc2902e0 TO IDX_14C967D2EA1CE9BE');
        $this->addSql('ALTER TABLE attributions RENAME INDEX idx_14c967d2c94d6cb2 TO IDX_14C967D2F7F147C8');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE attributions CHANGE heure heure INT DEFAULT NULL, CHANGE jour jour VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE attributions RENAME INDEX idx_14c967d2f7f147c8 TO IDX_14C967D2C94D6CB2');
        $this->addSql('ALTER TABLE attributions RENAME INDEX idx_14c967d2ea1ce9be TO IDX_14C967D2DC2902E0');
    }
}
