<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200622170304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campeonatos (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, juego VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, director VARCHAR(15) NOT NULL, miembros LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participaciones (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, campeonato INT DEFAULT NULL, INDEX IDX_B769E4738D93D649 (user), INDEX IDX_B769E473722DB8CA (campeonato), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pruebas (id INT AUTO_INCREMENT NOT NULL, campeonato INT DEFAULT NULL, prueba VARCHAR(255) NOT NULL, fecha DATE NOT NULL, INDEX IDX_F49DAE3F722DB8CA (campeonato), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E4738D93D649 FOREIGN KEY (user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E473722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
        $this->addSql('ALTER TABLE pruebas ADD CONSTRAINT FK_F49DAE3F722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E473722DB8CA');
        $this->addSql('ALTER TABLE pruebas DROP FOREIGN KEY FK_F49DAE3F722DB8CA');
        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E4738D93D649');
        $this->addSql('DROP TABLE campeonatos');
        $this->addSql('DROP TABLE equipos');
        $this->addSql('DROP TABLE participaciones');
        $this->addSql('DROP TABLE pruebas');
        $this->addSql('DROP TABLE users');
    }
}
