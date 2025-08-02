<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250802131621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pricing_plan_benefit DROP CONSTRAINT fk_e6a62c5fba2617b2');
        $this->addSql('DROP INDEX idx_e6a62c5fba2617b2');
        $this->addSql('ALTER TABLE pricing_plan_benefit RENAME COLUMN prinig_plan_id TO pricing_plan_id');
        $this->addSql('ALTER TABLE pricing_plan_benefit ADD CONSTRAINT FK_E6A62C5F29628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E6A62C5F29628C71 ON pricing_plan_benefit (pricing_plan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pricing_plan_benefit DROP CONSTRAINT FK_E6A62C5F29628C71');
        $this->addSql('DROP INDEX IDX_E6A62C5F29628C71');
        $this->addSql('ALTER TABLE pricing_plan_benefit RENAME COLUMN pricing_plan_id TO prinig_plan_id');
        $this->addSql('ALTER TABLE pricing_plan_benefit ADD CONSTRAINT fk_e6a62c5fba2617b2 FOREIGN KEY (prinig_plan_id) REFERENCES pricing_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e6a62c5fba2617b2 ON pricing_plan_benefit (prinig_plan_id)');
    }
}
