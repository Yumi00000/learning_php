<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250802122011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prinig_plan (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prinig_plan_prinig_plan_feature (prinig_plan_id INT NOT NULL, prinig_plan_feature_id INT NOT NULL, PRIMARY KEY(prinig_plan_id, prinig_plan_feature_id))');
        $this->addSql('CREATE INDEX IDX_1A8BDCCABA2617B2 ON prinig_plan_prinig_plan_feature (prinig_plan_id)');
        $this->addSql('CREATE INDEX IDX_1A8BDCCA77197570 ON prinig_plan_prinig_plan_feature (prinig_plan_feature_id)');
        $this->addSql('CREATE TABLE prinig_plan_banefit (id SERIAL NOT NULL, prinig_plan_id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_943C6622BA2617B2 ON prinig_plan_banefit (prinig_plan_id)');
        $this->addSql('CREATE TABLE prinig_plan_feature (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature ADD CONSTRAINT FK_1A8BDCCABA2617B2 FOREIGN KEY (prinig_plan_id) REFERENCES prinig_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature ADD CONSTRAINT FK_1A8BDCCA77197570 FOREIGN KEY (prinig_plan_feature_id) REFERENCES prinig_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_banefit ADD CONSTRAINT FK_943C6622BA2617B2 FOREIGN KEY (prinig_plan_id) REFERENCES prinig_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT fkhnfgqyjx3i80qoymrssls3kno');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT fkl5mnj9n0di7k1v90yxnthkc73');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT fk32ql8ubntj5uh44ph9659tiih');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE orders');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE users (id BIGINT NOT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, postal_address VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX ukr43af9ap4edm43mmtq01oddj6 ON users (username)');
        $this->addSql('CREATE TABLE order_product (order_id BIGINT NOT NULL, product_id BIGINT NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2530ADE64584665A ON order_product (product_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE68D9F6D38 ON order_product (order_id)');
        $this->addSql('CREATE TABLE product (id BIGINT NOT NULL, description VARCHAR(100) NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE orders (id BIGINT NOT NULL, user_id BIGINT NOT NULL, order_status VARCHAR(255) DEFAULT NULL, "timestamp" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT fkhnfgqyjx3i80qoymrssls3kno FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT fkl5mnj9n0di7k1v90yxnthkc73 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT fk32ql8ubntj5uh44ph9659tiih FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature DROP CONSTRAINT FK_1A8BDCCABA2617B2');
        $this->addSql('ALTER TABLE prinig_plan_prinig_plan_feature DROP CONSTRAINT FK_1A8BDCCA77197570');
        $this->addSql('ALTER TABLE prinig_plan_banefit DROP CONSTRAINT FK_943C6622BA2617B2');
        $this->addSql('DROP TABLE prinig_plan');
        $this->addSql('DROP TABLE prinig_plan_prinig_plan_feature');
        $this->addSql('DROP TABLE prinig_plan_banefit');
        $this->addSql('DROP TABLE prinig_plan_feature');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
