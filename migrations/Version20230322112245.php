<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322112245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clutter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lift (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, clutter_id INT DEFAULT NULL, station_id INT DEFAULT NULL, opening TIME NOT NULL, closing TIME NOT NULL, message VARCHAR(255) DEFAULT NULL, forced_closure TINYINT(1) DEFAULT NULL, INDEX IDX_737D1E0CC54C8C93 (type_id), INDEX IDX_737D1E0C6CD0DA6 (clutter_id), INDEX IDX_737D1E0C21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, domain_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, INDEX IDX_9F39F8B1115F0EE5 (domain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT DEFAULT NULL, level_id INT DEFAULT NULL, material_id INT DEFAULT NULL, clutter_id INT DEFAULT NULL, station_id INT DEFAULT NULL, opening TIME NOT NULL, closing TIME NOT NULL, message VARCHAR(255) DEFAULT NULL, forced_closure TINYINT(1) DEFAULT NULL, INDEX IDX_D6E3F8A6FCFA9DAE (difficulty_id), INDEX IDX_D6E3F8A65FB14BA7 (level_id), INDEX IDX_D6E3F8A6E308AC6F (material_id), INDEX IDX_D6E3F8A66CD0DA6 (clutter_id), INDEX IDX_D6E3F8A621BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, station_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64921BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lift ADD CONSTRAINT FK_737D1E0CC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE lift ADD CONSTRAINT FK_737D1E0C6CD0DA6 FOREIGN KEY (clutter_id) REFERENCES clutter (id)');
        $this->addSql('ALTER TABLE lift ADD CONSTRAINT FK_737D1E0C21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B1115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A65FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A66CD0DA6 FOREIGN KEY (clutter_id) REFERENCES clutter (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A621BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64921BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lift DROP FOREIGN KEY FK_737D1E0CC54C8C93');
        $this->addSql('ALTER TABLE lift DROP FOREIGN KEY FK_737D1E0C6CD0DA6');
        $this->addSql('ALTER TABLE lift DROP FOREIGN KEY FK_737D1E0C21BDB235');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B1115F0EE5');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A6FCFA9DAE');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A65FB14BA7');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A6E308AC6F');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A66CD0DA6');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A621BDB235');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64921BDB235');
        $this->addSql('DROP TABLE clutter');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE domain');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE lift');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
