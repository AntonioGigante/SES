<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117192808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipos DROP foto, CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipos ADD foto VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
