<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170301000541 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('create schema cryoblock');

        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.carbon_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ext_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class)');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at)');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username)');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE cryoblock.attachment (id SERIAL NOT NULL, name VARCHAR(500) NOT NULL, download_path VARCHAR(500) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deletedAt TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cryoblock.comment (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, created_by_id INT NOT NULL, path VARCHAR(3000) DEFAULT NULL, level INT DEFAULT NULL, content TEXT NOT NULL, html_content TEXT DEFAULT NULL, object_type VARCHAR(300) NOT NULL, object_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9AE8EC4F727ACA70 ON cryoblock.comment (parent_id)');
        $this->addSql('CREATE INDEX IDX_9AE8EC4FB03A8386 ON cryoblock.comment (created_by_id)');
        $this->addSql('CREATE TABLE cryoblock.carbon_group (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A05441DA5E237E06 ON cryoblock.carbon_group (name)');
        $this->addSql('CREATE TABLE cryoblock.group_role (id SERIAL NOT NULL, group_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7C775F4FE54D947 ON cryoblock.group_role (group_id)');
        $this->addSql('CREATE INDEX IDX_C7C775F4D60322AC ON cryoblock.group_role (role_id)');
        $this->addSql('CREATE TABLE cryoblock.object_notification (id SERIAL NOT NULL, on_create_group_id INT DEFAULT NULL, on_update_group_id INT DEFAULT NULL, on_delete_group_id INT DEFAULT NULL, object_type VARCHAR(300) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_292910D5B51CD427 ON cryoblock.object_notification (on_create_group_id)');
        $this->addSql('CREATE INDEX IDX_292910D5EF7C82B2 ON cryoblock.object_notification (on_update_group_id)');
        $this->addSql('CREATE INDEX IDX_292910D5A9F17C06 ON cryoblock.object_notification (on_delete_group_id)');
        $this->addSql('CREATE TABLE cryoblock.role (id SERIAL NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_375FBA7957698A6A ON cryoblock.role (role)');
        $this->addSql('CREATE TABLE cryoblock."user" (id SERIAL NOT NULL, avatar_attachment_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, first_name VARCHAR(55) DEFAULT NULL, last_name VARCHAR(55) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, api_key VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDA5E65A92FC23A8 ON cryoblock."user" (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDA5E65AA0D96FBF ON cryoblock."user" (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDA5E65AFCFDC5B7 ON cryoblock."user" (avatar_attachment_id)');
        $this->addSql('CREATE TABLE cryoblock.user_group (id SERIAL NOT NULL, user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36F61B73A76ED395 ON cryoblock.user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_36F61B73FE54D947 ON cryoblock.user_group (group_id)');
        $this->addSql('ALTER TABLE cryoblock.comment ADD CONSTRAINT FK_9AE8EC4F727ACA70 FOREIGN KEY (parent_id) REFERENCES cryoblock.comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.comment ADD CONSTRAINT FK_9AE8EC4FB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_role ADD CONSTRAINT FK_C7C775F4FE54D947 FOREIGN KEY (group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_role ADD CONSTRAINT FK_C7C775F4D60322AC FOREIGN KEY (role_id) REFERENCES cryoblock.role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.object_notification ADD CONSTRAINT FK_292910D5B51CD427 FOREIGN KEY (on_create_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.object_notification ADD CONSTRAINT FK_292910D5EF7C82B2 FOREIGN KEY (on_update_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.object_notification ADD CONSTRAINT FK_292910D5A9F17C06 FOREIGN KEY (on_delete_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock."user" ADD CONSTRAINT FK_EDA5E65AFCFDC5B7 FOREIGN KEY (avatar_attachment_id) REFERENCES cryoblock.attachment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_group ADD CONSTRAINT FK_36F61B73A76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_group ADD CONSTRAINT FK_36F61B73FE54D947 FOREIGN KEY (group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('INSERT INTO cryoblock.carbon_group VALUES (1, \'admin\')');
        $this->addSql('INSERT INTO cryoblock.role VALUES (1, \'ROLE_ADMIN\')');
        $this->addSql('INSERT INTO cryoblock.group_role VALUES (1, 1, 1)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('drop schema cryoblock CASCADE');
        $this->addSql('DROP SEQUENCE ext_log_entries_id_seq');
    }
}
