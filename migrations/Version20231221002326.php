<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221002326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beetle (id INT AUTO_INCREMENT NOT NULL, child_of_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, gen VARCHAR(255) DEFAULT NULL, lineage VARCHAR(255) DEFAULT NULL, sex VARCHAR(1) DEFAULT NULL, date DATE DEFAULT NULL, length VARCHAR(255) DEFAULT NULL, INDEX IDX_EBC810E90B01EF (child_of_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beetle ADD CONSTRAINT FK_EBC810E90B01EF FOREIGN KEY (child_of_id) REFERENCES relationship (id)');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A02055B9A2 FOREIGN KEY (father_id) REFERENCES beetle (id)');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A0B78A354D FOREIGN KEY (mother_id) REFERENCES beetle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relationship DROP FOREIGN KEY FK_200444A02055B9A2');
        $this->addSql('ALTER TABLE relationship DROP FOREIGN KEY FK_200444A0B78A354D');
        $this->addSql('ALTER TABLE beetle DROP FOREIGN KEY FK_EBC810E90B01EF');
        $this->addSql('DROP TABLE beetle');
    }
}
