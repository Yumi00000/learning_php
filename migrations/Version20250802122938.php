<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250802122938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE prinig_plan_id_seq CASCADE');
        $this->addSql('CREATE TABLE pricing_plan_prinig_plan_feature (pricing_plan_id INT NOT NULL, prinig_plan_feature_id INT NOT NULL, PRIMARY KEY(pricing_plan_id, prinig_plan_feature_id))');
        $this->addSql('CREATE INDEX IDX_97FD39CE29628C71 ON pricing_plan_prinig_plan_feature (pricing_plan_id)');
        $this->addSql('CREATE INDEX IDX_97FD39CE77197570 ON pricing_plan_prinig_plan_feature (prinig_plan_feature_id)');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature ADD CONSTRAINT FK_97FD39CE29628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature ADD CONSTRAINT FK_97FD39CE77197570 FOREIGN KEY (prinig_plan_feature_id) REFERENCES prinig_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature DROP CONSTRAINT fk_1a8bdcca77197570');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature DROP CONSTRAINT fk_1a8bdccaba2617b2');
        $this->addSql('DROP TABLE prinig_plan_prinig_plan_feature');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE prinig_plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE prinig_plan_prinig_plan_feature (prinig_plan_id INT NOT NULL, prinig_plan_feature_id INT NOT NULL, PRIMARY KEY(prinig_plan_id, prinig_plan_feature_id))');
        $this->addSql('CREATE INDEX idx_1a8bdcca77197570 ON prinig_plan_prinig_plan_feature (prinig_plan_feature_id)');
        $this->addSql('CREATE INDEX idx_1a8bdccaba2617b2 ON prinig_plan_prinig_plan_feature (prinig_plan_id)');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature ADD CONSTRAINT fk_1a8bdcca77197570 FOREIGN KEY (prinig_plan_feature_id) REFERENCES prinig_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature ADD CONSTRAINT fk_1a8bdccaba2617b2 FOREIGN KEY (prinig_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature DROP CONSTRAINT FK_97FD39CE29628C71');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature DROP CONSTRAINT FK_97FD39CE77197570');
        $this->addSql('DROP TABLE pricing_plan_prinig_plan_feature');
    }
}
