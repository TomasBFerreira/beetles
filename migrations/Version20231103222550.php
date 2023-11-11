<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103222550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beetle ADD male_parent_id INT DEFAULT NULL, ADD female_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beetle ADD CONSTRAINT FK_EBC810EE94E9D86 FOREIGN KEY (male_parent_id) REFERENCES beetle (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE beetle ADD CONSTRAINT FK_EBC810ECF27B01F FOREIGN KEY (female_parent_id) REFERENCES beetle (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EBC810EE94E9D86 ON beetle (male_parent_id)');
        $this->addSql('CREATE INDEX IDX_EBC810ECF27B01F ON beetle (female_parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beetle DROP FOREIGN KEY FK_EBC810EE94E9D86');
        $this->addSql('ALTER TABLE beetle DROP FOREIGN KEY FK_EBC810ECF27B01F');
        $this->addSql('DROP INDEX IDX_EBC810EE94E9D86 ON beetle');
        $this->addSql('DROP INDEX IDX_EBC810ECF27B01F ON beetle');
        $this->addSql('ALTER TABLE beetle DROP male_parent_id, DROP female_parent_id');
    }
}
