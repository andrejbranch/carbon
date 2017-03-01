<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170301155053 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('create schema storage');

        $this->addSql('CREATE SEQUENCE storage.division_sample_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.division_storage_container_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.protocol_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.sample_linked_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.sample_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.storage_container_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE storage.division (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, has_dimension BOOLEAN NOT NULL, height INT DEFAULT NULL, width INT DEFAULT NULL, availableSlots INT NOT NULL, usedSlots INT NOT NULL, totalSlots INT NOT NULL, percentFull NUMERIC(20, 3) NOT NULL, path VARCHAR(3000) DEFAULT NULL, title VARCHAR(64) NOT NULL, level INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5404ACC5727ACA70 ON storage.division (parent_id)');
        $this->addSql('CREATE TABLE storage.division_sample_type (id INT NOT NULL, sample_type_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B60F015D5064105 ON storage.division_sample_type (sample_type_id)');
        $this->addSql('CREATE INDEX IDX_7B60F01541859289 ON storage.division_sample_type (division_id)');
        $this->addSql('CREATE TABLE storage.division_storage_container (id INT NOT NULL, storage_container_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C2E3EE67F04277E5 ON storage.division_storage_container (storage_container_id)');
        $this->addSql('CREATE INDEX IDX_C2E3EE6741859289 ON storage.division_storage_container (division_id)');
        $this->addSql('CREATE TABLE storage.project (id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, notes TEXT NOT NULL, status VARCHAR(255) NOT NULL, id_created_by INT NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE storage.protocol (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, notes TEXT NOT NULL, createdBy INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updatedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deletedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, archivedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE storage.sample (id INT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, division_id INT DEFAULT NULL, sample_type_id INT NOT NULL, storage_container_id INT NOT NULL, protocol_id INT DEFAULT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, notes TEXT DEFAULT NULL, division_row VARCHAR(1) DEFAULT NULL, division_column INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, archived_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, volume NUMERIC(3, 0) DEFAULT NULL, storage_buffer VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, vector_name VARCHAR(150) DEFAULT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, dna_sequence TEXT DEFAULT NULL, amino_acid_sequence TEXT DEFAULT NULL, amino_acid_count INT DEFAULT NULL, molecular_weight NUMERIC(20, 3) DEFAULT NULL, extinction_coefficient NUMERIC(20, 3) DEFAULT NULL, purification_tags VARCHAR(150) DEFAULT NULL, species VARCHAR(300) DEFAULT NULL, cell_line VARCHAR(300) DEFAULT NULL, mass NUMERIC(20, 3) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8017595DB03A8386 ON storage.sample (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8017595D896DBBDE ON storage.sample (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_8017595D41859289 ON storage.sample (division_id)');
        $this->addSql('CREATE INDEX IDX_8017595DD5064105 ON storage.sample (sample_type_id)');
        $this->addSql('CREATE INDEX IDX_8017595DF04277E5 ON storage.sample (storage_container_id)');
        $this->addSql('CREATE INDEX IDX_8017595DCCD59258 ON storage.sample (protocol_id)');
        $this->addSql('CREATE TABLE storage.sample_linked_sample (id INT NOT NULL, parent_sample_id INT NOT NULL, child_sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6CBDE20EEA54C5CE ON storage.sample_linked_sample (parent_sample_id)');
        $this->addSql('CREATE INDEX IDX_6CBDE20ECA2E8AAC ON storage.sample_linked_sample (child_sample_id)');
        $this->addSql('CREATE TABLE storage.sample_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE storage.storage_container (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE storage.division ADD CONSTRAINT FK_5404ACC5727ACA70 FOREIGN KEY (parent_id) REFERENCES storage.division (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_sample_type ADD CONSTRAINT FK_7B60F015D5064105 FOREIGN KEY (sample_type_id) REFERENCES storage.sample_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_sample_type ADD CONSTRAINT FK_7B60F01541859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_storage_container ADD CONSTRAINT FK_C2E3EE67F04277E5 FOREIGN KEY (storage_container_id) REFERENCES storage.storage_container (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_storage_container ADD CONSTRAINT FK_C2E3EE6741859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595D41859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DD5064105 FOREIGN KEY (sample_type_id) REFERENCES storage.sample_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DF04277E5 FOREIGN KEY (storage_container_id) REFERENCES storage.storage_container (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DCCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample_linked_sample ADD CONSTRAINT FK_6CBDE20EEA54C5CE FOREIGN KEY (parent_sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample_linked_sample ADD CONSTRAINT FK_6CBDE20ECA2E8AAC FOREIGN KEY (child_sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.comment DROP CONSTRAINT FK_9AE8EC4FB03A8386');
        $this->addSql('ALTER TABLE cryoblock.comment ADD CONSTRAINT FK_9AE8EC4FB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_group DROP CONSTRAINT FK_36F61B73A76ED395');
        $this->addSql('ALTER TABLE cryoblock.user_group ADD CONSTRAINT FK_36F61B73A76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("INSERT INTO storage.sample_type (id, name) VALUES (1, 'DNA'), (2, 'Protein'), (3, 'Sera'), (4, 'Bacterial Cells'), (5, 'Mammalian Cells'), (6, 'Yeast Cells'), (7, 'Chemical Compound'), (8, 'Solution'), (9, 'Other')");
        $this->addSql("INSERT INTO storage.storage_container (id, name) VALUES (1, '1.5-2.0 mL Eppendorf Tube'), (2, '15 mL Falcon'), (3, '50 mL Falcon'), (4, 'Vial'), (5, 'PCR tube'), (6, 'PCR strip'), (7, '96 well plate'), (8, 'Bag'), (9, 'Box')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('drop schema storage cascade');
    }
}
