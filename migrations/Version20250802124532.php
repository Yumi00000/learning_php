<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250802124532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE prinig_plan_banefit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prinig_plan_feature_id_seq CASCADE');
        $this->addSql('CREATE TABLE pricing_plan_pricing_plan_feature (pricing_plan_id INT NOT NULL, pricing_plan_feature_id INT NOT NULL, PRIMARY KEY(pricing_plan_id, pricing_plan_feature_id))');
        $this->addSql('CREATE INDEX IDX_D19087D429628C71 ON pricing_plan_pricing_plan_feature (pricing_plan_id)');
        $this->addSql('CREATE INDEX IDX_D19087D46C9002D8 ON pricing_plan_pricing_plan_feature (pricing_plan_feature_id)');
        $this->addSql('CREATE TABLE pricing_plan_benefit (id SERIAL NOT NULL, prinig_plan_id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E6A62C5FBA2617B2 ON pricing_plan_benefit (prinig_plan_id)');
        $this->addSql('CREATE TABLE pricing_plan_feature (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D429628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D46C9002D8 FOREIGN KEY (pricing_plan_feature_id) REFERENCES pricing_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_benefit ADD CONSTRAINT FK_E6A62C5FBA2617B2 FOREIGN KEY (prinig_plan_id) REFERENCES pricing_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_banefit DROP CONSTRAINT fk_943c6622ba2617b2');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature DROP CONSTRAINT fk_97fd39ce29628c71');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature DROP CONSTRAINT fk_97fd39ce77197570');
        $this->addSql('DROP TABLE prinig_plan_feature');
        $this->addSql('DROP TABLE prinig_plan_banefit');
        $this->addSql('DROP TABLE pricing_plan_prinig_plan_feature');
        $this->addSql('CREATE SEQUENCE pricing_plan_id_seq');
        $this->addSql('SELECT setval(\'pricing_plan_id_seq\', (SELECT MAX(id) FROM pricing_plan))');
        $this->addSql('ALTER TABLE pricing_plan ALTER id SET DEFAULT nextval(\'pricing_plan_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE prinig_plan_banefit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prinig_plan_feature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE prinig_plan_feature (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prinig_plan_banefit (id SERIAL NOT NULL, prinig_plan_id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_943c6622ba2617b2 ON prinig_plan_banefit (prinig_plan_id)');
        $this->addSql('CREATE TABLE pricing_plan_prinig_plan_feature (pricing_plan_id INT NOT NULL, prinig_plan_feature_id INT NOT NULL, PRIMARY KEY(pricing_plan_id, prinig_plan_feature_id))');
        $this->addSql('CREATE INDEX idx_97fd39ce29628c71 ON pricing_plan_prinig_plan_feature (pricing_plan_id)');
        $this->addSql('CREATE INDEX idx_97fd39ce77197570 ON pricing_plan_prinig_plan_feature (prinig_plan_feature_id)');
        $this->addSql('ALTER TABLE prinig_plan_banefit ADD CONSTRAINT fk_943c6622ba2617b2 FOREIGN KEY (prinig_plan_id) REFERENCES pricing_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature ADD CONSTRAINT fk_97fd39ce29628c71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_prinig_plan_feature ADD CONSTRAINT fk_97fd39ce77197570 FOREIGN KEY (prinig_plan_feature_id) REFERENCES prinig_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP CONSTRAINT FK_D19087D429628C71');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP CONSTRAINT FK_D19087D46C9002D8');
        $this->addSql('ALTER TABLE pricing_plan_benefit DROP CONSTRAINT FK_E6A62C5FBA2617B2');
        $this->addSql('DROP TABLE pricing_plan_pricing_plan_feature');
        $this->addSql('DROP TABLE pricing_plan_benefit');
        $this->addSql('DROP TABLE pricing_plan_feature');
        $this->addSql('ALTER TABLE pricing_plan ALTER id DROP DEFAULT');
    }
}
