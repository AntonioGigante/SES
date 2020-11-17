<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616182947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, director VARCHAR(15) NOT NULL, miembros LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', competicionesapuntadas INT NOT NULL, competicionesganadas INT NOT NULL, partidos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pruebas (id INT AUTO_INCREMENT NOT NULL, campeonato_id INT DEFAULT NULL, prueba VARCHAR(255) NOT NULL, fecha DATE NOT NULL, INDEX IDX_F49DAE3F93BAAE11 (campeonato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participaciones (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, campeonato INT DEFAULT NULL, INDEX IDX_B769E473A76ED395 (user_id), INDEX IDX_B769E473722DB8CA (campeonato), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, victorias INT DEFAULT NULL, competicionesapuntado INT DEFAULT NULL, competicionesganadas INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pruebas ADD CONSTRAINT FK_F49DAE3F93BAAE11 FOREIGN KEY (campeonato_id) REFERENCES campeonatos (id)');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E473A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participaciones ADD CONSTRAINT FK_B769E473722DB8CA FOREIGN KEY (campeonato) REFERENCES campeonatos (id)');
        $this->addSql('ALTER TABLE campeonatos CHANGE campeonato descripcion VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participaciones DROP FOREIGN KEY FK_B769E473A76ED395');
        $this->addSql('DROP TABLE equipos');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE pruebas');
        $this->addSql('DROP TABLE participaciones');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE campeonatos CHANGE descripcion campeonato VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
