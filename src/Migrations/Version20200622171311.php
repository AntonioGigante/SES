<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200622171311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E473A76ED395');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP INDEX IDX_B769E473A76ED395 ON participaciones');
        $this->addSql('ALTER TABLE participaciones ADD id INT AUTO_INCREMENT NOT NULL, ADD user INT DEFAULT NULL, ADD campeonato INT DEFAULT NULL, DROP user_id, DROP campeonato_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E4738D93D649 FOREIGN KEY (user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E473722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
        $this->addSql('CREATE INDEX IDX_B769E4738D93D649 ON participaciones (user)');
        $this->addSql('CREATE INDEX IDX_B769E473722DB8CA ON participaciones (campeonato)');
        $this->addSql('ALTER TABLE pruebas DROP FOREIGN KEY FK_F49DAE3FBF396750');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas ADD CONSTRAINT FK_F49DAE3F722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
        $this->addSql('CREATE INDEX IDX_F49DAE3F722DB8CA ON pruebas (campeonato)');
        $this->addSql('ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, director VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, miembros LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participaciones MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E4738D93D649');
        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E473722DB8CA');
        $this->addSql('DROP INDEX IDX_B769E4738D93D649 ON participaciones');
        $this->addSql('DROP INDEX IDX_B769E473722DB8CA ON participaciones');
        $this->addSql('ALTER TABLE participaciones DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE participaciones ADD user_id INT NOT NULL, ADD campeonato_id INT NOT NULL, DROP id, DROP user, DROP campeonato');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E473A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B769E473A76ED395 ON participaciones (user_id)');
        $this->addSql('ALTER TABLE participaciones ADD PRIMARY KEY (user_id, campeonato_id)');
        $this->addSql('ALTER TABLE pruebas DROP FOREIGN KEY FK_F49DAE3F722DB8CA');
        $this->addSql('DROP INDEX IDX_F49DAE3F722DB8CA ON pruebas');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pruebas ADD CONSTRAINT FK_F49DAE3FBF396750 FOREIGN KEY (id) REFERENCES campeonatos (id)');
        $this->addSql('ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
