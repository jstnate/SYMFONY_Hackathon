<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322075529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clutter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lift_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lifts (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, clutter_id INT DEFAULT NULL, opening TIME NOT NULL, closing TIME NOT NULL, message VARCHAR(255) DEFAULT NULL, forced_closure TINYINT(1) DEFAULT NULL, INDEX IDX_12CBFE3EC54C8C93 (type_id), INDEX IDX_12CBFE3E6CD0DA6 (clutter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track_diffuclty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracks (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT DEFAULT NULL, level_id INT DEFAULT NULL, material_id INT DEFAULT NULL, clutter_id INT DEFAULT NULL, opening TIME NOT NULL, closure TIME NOT NULL, message VARCHAR(255) DEFAULT NULL, forced_closure TINYINT(1) DEFAULT NULL, INDEX IDX_246D2A2EFCFA9DAE (difficulty_id), INDEX IDX_246D2A2E5FB14BA7 (level_id), INDEX IDX_246D2A2EE308AC6F (material_id), INDEX IDX_246D2A2E6CD0DA6 (clutter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, domain_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D649115F0EE5 (domain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lifts ADD CONSTRAINT FK_12CBFE3EC54C8C93 FOREIGN KEY (type_id) REFERENCES lift_type (id)');
        $this->addSql('ALTER TABLE lifts ADD CONSTRAINT FK_12CBFE3E6CD0DA6 FOREIGN KEY (clutter_id) REFERENCES clutter (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2EFCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES track_diffuclty (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E6CD0DA6 FOREIGN KEY (clutter_id) REFERENCES clutter (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lifts DROP FOREIGN KEY FK_12CBFE3EC54C8C93');
        $this->addSql('ALTER TABLE lifts DROP FOREIGN KEY FK_12CBFE3E6CD0DA6');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2EFCFA9DAE');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E5FB14BA7');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2EE308AC6F');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E6CD0DA6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649115F0EE5');
        $this->addSql('DROP TABLE clutter');
        $this->addSql('DROP TABLE domain');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE lift_type');
        $this->addSql('DROP TABLE lifts');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE track_diffuclty');
        $this->addSql('DROP TABLE tracks');
        $this->addSql('DROP TABLE user');
    }
}
