<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322123215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('CREATE INDEX IDX_246D2A2E115F0EE5 ON tracks (domain_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649115F0EE5');
        $this->addSql('DROP INDEX IDX_8D93D649115F0EE5 ON user');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP domain_id, DROP description, DROP logo, CHANGE email email VARCHAR(180) NOT NULL, CHANGE name password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E115F0EE5');
        $this->addSql('DROP INDEX IDX_246D2A2E115F0EE5 ON tracks');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD domain_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649115F0EE5 ON user (domain_id)');
    }
}
