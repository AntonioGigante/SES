<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221102929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE miembros (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_E44A9A78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE miembros ADD CONSTRAINT FK_E44A9A78A76ED395 FOREIGN KEY (user_id) REFERENCES equipos (id)');
        $this->addSql('ALTER TABLE users ADD equipo_id INT DEFAULT NULL, CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E923BFBED FOREIGN KEY (equipo_id) REFERENCES miembros (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E923BFBED ON users (equipo_id)');
        $this->addSql('ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E923BFBED');
        $this->addSql('DROP TABLE miembros');
        $this->addSql('ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_1483A5E923BFBED ON users');
        $this->addSql('ALTER TABLE users DROP equipo_id, CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
