<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616182308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participante DROP FOREIGN KEY FK_85BDC5C393BAAE11');
        $this->addSql('ALTER TABLE prueba DROP FOREIGN KEY FK_46711E43722DB8CA');
        $this->addSql('ALTER TABLE participaciones_bk DROP FOREIGN KEY FK_B769E47393BAAE11');
        $this->addSql('ALTER TABLE pruebas_bk DROP FOREIGN KEY FK_F49DAE3F722DB8CA');
        $this->addSql('ALTER TABLE participante DROP FOREIGN KEY FK_85BDC5C3A76ED395');
        $this->addSql('ALTER TABLE participaciones_bk DROP FOREIGN KEY FK_B769E473A76ED395');
        $this->addSql('CREATE TABLE equipos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, director VARCHAR(15) NOT NULL, miembros LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participantes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, campeonato_id INT DEFAULT NULL, INDEX IDX_19E6E1C4A76ED395 (user_id), INDEX IDX_19E6E1C493BAAE11 (campeonato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participantes ADD CONSTRAINT FK_19E6E1C4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participantes ADD CONSTRAINT FK_19E6E1C493BAAE11 FOREIGN KEY (campeonato_id) REFERENCES campeonatos (id)');
        $this->addSql('DROP TABLE campeonato');
        $this->addSql('DROP TABLE campeonatos_bk');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE equipo_bk');
        $this->addSql('DROP TABLE participaciones');
        $this->addSql('DROP TABLE participaciones_bk');
        $this->addSql('DROP TABLE participante');
        $this->addSql('DROP TABLE prueba');
        $this->addSql('DROP TABLE pruebas_bk');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_bk');
        $this->addSql('ALTER TABLE campeonatos DROP pruebas, DROP participantes');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pruebas ADD CONSTRAINT FK_F49DAE3F722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
        $this->addSql('CREATE INDEX IDX_F49DAE3F722DB8CA ON pruebas (campeonato)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participantes DROP FOREIGN KEY FK_19E6E1C4A76ED395');
        $this->addSql('CREATE TABLE campeonato (id INT AUTO_INCREMENT NOT NULL, campeonato VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, juego VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE campeonatos_bk (id INT AUTO_INCREMENT NOT NULL, campeonato VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, juego VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, director VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, miembros LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipo_bk (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, director VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, miembros LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participaciones (user_id INT NOT NULL, campeonato_id INT NOT NULL, INDEX IDX_B769E473A76ED395 (user_id), INDEX IDX_B769E47393BAAE11 (campeonato_id), PRIMARY KEY(user_id, campeonato_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participaciones_bk (user_id INT NOT NULL, campeonato_id INT NOT NULL, INDEX IDX_B769E473A76ED395 (user_id), INDEX IDX_B769E47393BAAE11 (campeonato_id), PRIMARY KEY(user_id, campeonato_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participante (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, campeonato_id INT DEFAULT NULL, INDEX IDX_85BDC5C393BAAE11 (campeonato_id), INDEX IDX_85BDC5C3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prueba (id INT AUTO_INCREMENT NOT NULL, campeonato INT DEFAULT NULL, prueba VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, fecha DATE NOT NULL, INDEX IDX_46711E43722DB8CA (campeonato), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pruebas_bk (id INT AUTO_INCREMENT NOT NULL, campeonato INT DEFAULT NULL, prueba VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, fecha DATE NOT NULL, INDEX IDX_F49DAE3F722DB8CA (campeonato), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_bk (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participaciones_bk ADD CONSTRAINT FK_B769E47393BAAE11 FOREIGN KEY (campeonato_id) REFERENCES campeonatos_bk (id)');
        $this->addSql('ALTER TABLE participaciones_bk ADD CONSTRAINT FK_B769E473A76ED395 FOREIGN KEY (user_id) REFERENCES user_bk (id)');
        $this->addSql('ALTER TABLE participante ADD CONSTRAINT FK_85BDC5C393BAAE11 FOREIGN KEY (campeonato_id) REFERENCES campeonato (id)');
        $this->addSql('ALTER TABLE participante ADD CONSTRAINT FK_85BDC5C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prueba ADD CONSTRAINT FK_46711E43722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonato (id)');
        $this->addSql('ALTER TABLE pruebas_bk ADD CONSTRAINT FK_F49DAE3F722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos_bk (id)');
        $this->addSql('DROP TABLE equipos');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE participantes');
        $this->addSql('ALTER TABLE campeonatos ADD pruebas LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', ADD participantes LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\'');
        $this->addSql('ALTER TABLE pruebas DROP FOREIGN KEY FK_F49DAE3F722DB8CA');
        $this->addSql('DROP INDEX IDX_F49DAE3F722DB8CA ON pruebas');
        $this->addSql('ALTER TABLE pruebas CHANGE campeonato campeonato VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
