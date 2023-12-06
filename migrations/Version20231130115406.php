<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130115406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relationship (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, child_id INT DEFAULT NULL, INDEX IDX_200444A0727ACA70 (parent_id), INDEX IDX_200444A0DD62C21B (child_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A0727ACA70 FOREIGN KEY (parent_id) REFERENCES beetle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relationship ADD CONSTRAINT FK_200444A0DD62C21B FOREIGN KEY (child_id) REFERENCES beetle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beetle DROP FOREIGN KEY FK_EBC810EE94E9D86');
        $this->addSql('ALTER TABLE beetle DROP FOREIGN KEY FK_EBC810ECF27B01F');
        $this->addSql('DROP INDEX IDX_EBC810EE94E9D86 ON beetle');
        $this->addSql('DROP INDEX IDX_EBC810ECF27B01F ON beetle');
        $this->addSql('ALTER TABLE beetle DROP male_parent_id, DROP female_parent_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relationship DROP FOREIGN KEY FK_200444A0727ACA70');
        $this->addSql('ALTER TABLE relationship DROP FOREIGN KEY FK_200444A0DD62C21B');
        $this->addSql('DROP TABLE relationship');
        $this->addSql('ALTER TABLE beetle ADD male_parent_id INT DEFAULT NULL, ADD female_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beetle ADD CONSTRAINT FK_EBC810EE94E9D86 FOREIGN KEY (male_parent_id) REFERENCES beetle (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE beetle ADD CONSTRAINT FK_EBC810ECF27B01F FOREIGN KEY (female_parent_id) REFERENCES beetle (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EBC810EE94E9D86 ON beetle (male_parent_id)');
        $this->addSql('CREATE INDEX IDX_EBC810ECF27B01F ON beetle (female_parent_id)');
    }
}
