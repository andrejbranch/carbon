<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170505170421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE storage.division_group_editor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.division_group_viewer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.division_viewer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE storage.division_group_editor (id INT NOT NULL, group_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_383EE045FE54D947 ON storage.division_group_editor (group_id)');
        $this->addSql('CREATE INDEX IDX_383EE04541859289 ON storage.division_group_editor (division_id)');
        $this->addSql('CREATE TABLE storage.division_group_viewer (id INT NOT NULL, group_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F793BDAAFE54D947 ON storage.division_group_viewer (group_id)');
        $this->addSql('CREATE INDEX IDX_F793BDAA41859289 ON storage.division_group_viewer (division_id)');
        $this->addSql('CREATE TABLE storage.division_viewer (id INT NOT NULL, user_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BB7B145AA76ED395 ON storage.division_viewer (user_id)');
        $this->addSql('CREATE INDEX IDX_BB7B145A41859289 ON storage.division_viewer (division_id)');
        $this->addSql('ALTER TABLE storage.division_group_editor ADD CONSTRAINT FK_383EE045FE54D947 FOREIGN KEY (group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_group_editor ADD CONSTRAINT FK_383EE04541859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_group_viewer ADD CONSTRAINT FK_F793BDAAFE54D947 FOREIGN KEY (group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_group_viewer ADD CONSTRAINT FK_F793BDAA41859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_viewer ADD CONSTRAINT FK_BB7B145AA76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_viewer ADD CONSTRAINT FK_BB7B145A41859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division ADD id_path VARCHAR(3000) DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division ADD is_public_edit BOOLEAN NOT NULL DEFAULT FALSE');
        $this->addSql('ALTER TABLE storage.division ADD is_public_view BOOLEAN NOT NULL DEFAULT TRUE');
        $this->addSql('ALTER TABLE storage.division_editor DROP CONSTRAINT FK_74D649B5A76ED395');
        $this->addSql('ALTER TABLE storage.division_editor ADD CONSTRAINT FK_74D649B5A76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('INSERT INTO cryoblock.role VALUES (3, \'ROLE_INVENTORY_ADMIN\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        /** no down */
    }
}
