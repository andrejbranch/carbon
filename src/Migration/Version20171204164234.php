<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171204164234 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE production.native_gel_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.native_gel_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.native_gel_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sds_page_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sds_page_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sds_page_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sec_mals_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sec_mals_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.sec_mals_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.spr_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.spr_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.spr_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.western_gel_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.western_gel_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.western_gel_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.affinity_purification_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.affinity_purification_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.affinity_purification_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.affinity_purification_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.size_exclusion_purification_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.size_exclusion_purification_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.size_exclusion_purification_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.size_exclusion_purification_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production.native_gel_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_69A0C1AECCD59258 ON production.native_gel_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_69A0C1AEE80B93 ON production.native_gel_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_69A0C1AEB03A8386 ON production.native_gel_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_69A0C1AE896DBBDE ON production.native_gel_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.native_gel_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9998FEE8427EB8A5 ON production.native_gel_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_9998FEE81B1FEA20 ON production.native_gel_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.native_gel_request_project (id INT NOT NULL, request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36854C0427EB8A5 ON production.native_gel_request_project (request_id)');
        $this->addSql('CREATE INDEX IDX_36854C0166D1F9C ON production.native_gel_request_project (project_id)');
        $this->addSql('CREATE TABLE production.sds_page_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7818A995CCD59258 ON production.sds_page_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_7818A995E80B93 ON production.sds_page_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_7818A995B03A8386 ON production.sds_page_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_7818A995896DBBDE ON production.sds_page_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.sds_page_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7A52C382427EB8A5 ON production.sds_page_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_7A52C3821B1FEA20 ON production.sds_page_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.sds_page_request_project (id INT NOT NULL, request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C88F3643427EB8A5 ON production.sds_page_request_project (request_id)');
        $this->addSql('CREATE INDEX IDX_C88F3643166D1F9C ON production.sds_page_request_project (project_id)');
        $this->addSql('CREATE TABLE production.sec_mals_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12DC620FCCD59258 ON production.sec_mals_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_12DC620FE80B93 ON production.sec_mals_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_12DC620FB03A8386 ON production.sec_mals_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_12DC620F896DBBDE ON production.sec_mals_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.sec_mals_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A2E3913C427EB8A5 ON production.sec_mals_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_A2E3913C1B1FEA20 ON production.sec_mals_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.sec_mals_request_project (id INT NOT NULL, request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E12E6645427EB8A5 ON production.sec_mals_request_project (request_id)');
        $this->addSql('CREATE INDEX IDX_E12E6645166D1F9C ON production.sec_mals_request_project (project_id)');
        $this->addSql('CREATE TABLE production.spr_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D6F27CADCCD59258 ON production.spr_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_D6F27CADE80B93 ON production.spr_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_D6F27CADB03A8386 ON production.spr_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_D6F27CAD896DBBDE ON production.spr_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.spr_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_913C7E7D427EB8A5 ON production.spr_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_913C7E7D1B1FEA20 ON production.spr_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.spr_request_project (id INT NOT NULL, request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F944B7A427EB8A5 ON production.spr_request_project (request_id)');
        $this->addSql('CREATE INDEX IDX_1F944B7A166D1F9C ON production.spr_request_project (project_id)');
        $this->addSql('CREATE TABLE production.western_gel_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3A6A511DCCD59258 ON production.western_gel_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_3A6A511DE80B93 ON production.western_gel_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_3A6A511DB03A8386 ON production.western_gel_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_3A6A511D896DBBDE ON production.western_gel_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.western_gel_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEBB91BD427EB8A5 ON production.western_gel_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_FEBB91BD1B1FEA20 ON production.western_gel_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.western_gel_request_project (id INT NOT NULL, request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B197B71427EB8A5 ON production.western_gel_request_project (request_id)');
        $this->addSql('CREATE INDEX IDX_7B197B71166D1F9C ON production.western_gel_request_project (project_id)');
        $this->addSql('CREATE TABLE production.dna_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C16626427EB8A5 ON production.dna_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_A3C166261B1FEA20 ON production.dna_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.dna_request_output_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0F2090D427EB8A5 ON production.dna_request_output_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_E0F2090D1B1FEA20 ON production.dna_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.pipeline (id SERIAL NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6253B5ABB03A8386 ON production.pipeline (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6253B5AB896DBBDE ON production.pipeline (updated_by_id)');
        $this->addSql('CREATE TABLE production.pipeline_input_request (id SERIAL NOT NULL, from_pipeline_request_id INT DEFAULT NULL, to_pipeline_request_id INT DEFAULT NULL, from_request_id INT NOT NULL, to_request_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_799F2688B793AF5E ON production.pipeline_input_request (from_pipeline_request_id)');
        $this->addSql('CREATE INDEX IDX_799F2688F28F0270 ON production.pipeline_input_request (to_pipeline_request_id)');
        $this->addSql('CREATE TABLE production.pipeline_request (id SERIAL NOT NULL, name VARCHAR(300) NOT NULL, entity VARCHAR(300) NOT NULL, form_type VARCHAR(300) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE production.protein_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_96B28F06427EB8A5 ON production.protein_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_96B28F061B1FEA20 ON production.protein_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.affinity_purification_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, volume NUMERIC(3, 0) DEFAULT NULL, notes TEXT DEFAULT NULL, volume_units VARCHAR(15) DEFAULT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_155F90FACCD59258 ON production.affinity_purification_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_155F90FAE80B93 ON production.affinity_purification_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_155F90FAB03A8386 ON production.affinity_purification_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_155F90FA896DBBDE ON production.affinity_purification_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.affinity_purification_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_13B43D0427EB8A5 ON production.affinity_purification_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_13B43D01B1FEA20 ON production.affinity_purification_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.affinity_purification_request_output_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B48EA401427EB8A5 ON production.affinity_purification_request_output_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_B48EA4011B1FEA20 ON production.affinity_purification_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.affinity_purification_request_project (id INT NOT NULL, purification_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F40EDFD9DD40A90 ON production.affinity_purification_request_project (purification_request_id)');
        $this->addSql('CREATE INDEX IDX_8F40EDFD166D1F9C ON production.affinity_purification_request_project (project_id)');
        $this->addSql('CREATE TABLE production.size_exclusion_purification_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, volume NUMERIC(3, 0) DEFAULT NULL, notes TEXT DEFAULT NULL, volume_units VARCHAR(15) DEFAULT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_40E45D79CCD59258 ON production.size_exclusion_purification_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_40E45D79E80B93 ON production.size_exclusion_purification_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_40E45D79B03A8386 ON production.size_exclusion_purification_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_40E45D79896DBBDE ON production.size_exclusion_purification_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.size_exclusion_purification_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F107673C427EB8A5 ON production.size_exclusion_purification_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_F107673C1B1FEA20 ON production.size_exclusion_purification_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.size_exclusion_purification_request_output_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1DC23676427EB8A5 ON production.size_exclusion_purification_request_output_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_1DC236761B1FEA20 ON production.size_exclusion_purification_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.size_exclusion_purification_request_project (id INT NOT NULL, purification_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7FC032829DD40A90 ON production.size_exclusion_purification_request_project (purification_request_id)');
        $this->addSql('CREATE INDEX IDX_7FC03282166D1F9C ON production.size_exclusion_purification_request_project (project_id)');

        $this->addSql('ALTER TABLE production.native_gel_request ADD CONSTRAINT FK_69A0C1AECCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request ADD CONSTRAINT FK_69A0C1AEE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request ADD CONSTRAINT FK_69A0C1AEB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request ADD CONSTRAINT FK_69A0C1AE896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request_input_sample ADD CONSTRAINT FK_9998FEE8427EB8A5 FOREIGN KEY (request_id) REFERENCES production.native_gel_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request_input_sample ADD CONSTRAINT FK_9998FEE81B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request_project ADD CONSTRAINT FK_36854C0427EB8A5 FOREIGN KEY (request_id) REFERENCES production.native_gel_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.native_gel_request_project ADD CONSTRAINT FK_36854C0166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request ADD CONSTRAINT FK_7818A995CCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request ADD CONSTRAINT FK_7818A995E80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request ADD CONSTRAINT FK_7818A995B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request ADD CONSTRAINT FK_7818A995896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request_input_sample ADD CONSTRAINT FK_7A52C382427EB8A5 FOREIGN KEY (request_id) REFERENCES production.sds_page_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request_input_sample ADD CONSTRAINT FK_7A52C3821B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request_project ADD CONSTRAINT FK_C88F3643427EB8A5 FOREIGN KEY (request_id) REFERENCES production.sds_page_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sds_page_request_project ADD CONSTRAINT FK_C88F3643166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request ADD CONSTRAINT FK_12DC620FCCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request ADD CONSTRAINT FK_12DC620FE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request ADD CONSTRAINT FK_12DC620FB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request ADD CONSTRAINT FK_12DC620F896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request_input_sample ADD CONSTRAINT FK_A2E3913C427EB8A5 FOREIGN KEY (request_id) REFERENCES production.sec_mals_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request_input_sample ADD CONSTRAINT FK_A2E3913C1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request_project ADD CONSTRAINT FK_E12E6645427EB8A5 FOREIGN KEY (request_id) REFERENCES production.sec_mals_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.sec_mals_request_project ADD CONSTRAINT FK_E12E6645166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request ADD CONSTRAINT FK_D6F27CADCCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request ADD CONSTRAINT FK_D6F27CADE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request ADD CONSTRAINT FK_D6F27CADB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request ADD CONSTRAINT FK_D6F27CAD896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_input_sample ADD CONSTRAINT FK_913C7E7D427EB8A5 FOREIGN KEY (request_id) REFERENCES production.spr_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_input_sample ADD CONSTRAINT FK_913C7E7D1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_project ADD CONSTRAINT FK_1F944B7A427EB8A5 FOREIGN KEY (request_id) REFERENCES production.spr_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_project ADD CONSTRAINT FK_1F944B7A166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request ADD CONSTRAINT FK_3A6A511DCCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request ADD CONSTRAINT FK_3A6A511DE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request ADD CONSTRAINT FK_3A6A511DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request ADD CONSTRAINT FK_3A6A511D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request_input_sample ADD CONSTRAINT FK_FEBB91BD427EB8A5 FOREIGN KEY (request_id) REFERENCES production.western_gel_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request_input_sample ADD CONSTRAINT FK_FEBB91BD1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request_project ADD CONSTRAINT FK_7B197B71427EB8A5 FOREIGN KEY (request_id) REFERENCES production.western_gel_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.western_gel_request_project ADD CONSTRAINT FK_7B197B71166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_input_sample ADD CONSTRAINT FK_A3C16626427EB8A5 FOREIGN KEY (request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_input_sample ADD CONSTRAINT FK_A3C166261B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_output_sample ADD CONSTRAINT FK_E0F2090D427EB8A5 FOREIGN KEY (request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_output_sample ADD CONSTRAINT FK_E0F2090D1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline ADD CONSTRAINT FK_6253B5ABB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline ADD CONSTRAINT FK_6253B5AB896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline_input_request ADD CONSTRAINT FK_799F2688B793AF5E FOREIGN KEY (from_pipeline_request_id) REFERENCES production.pipeline_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline_input_request ADD CONSTRAINT FK_799F2688F28F0270 FOREIGN KEY (to_pipeline_request_id) REFERENCES production.pipeline_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_input_sample ADD CONSTRAINT FK_96B28F06427EB8A5 FOREIGN KEY (request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_input_sample ADD CONSTRAINT FK_96B28F061B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request ADD CONSTRAINT FK_155F90FACCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request ADD CONSTRAINT FK_155F90FAE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request ADD CONSTRAINT FK_155F90FAB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request ADD CONSTRAINT FK_155F90FA896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_input_sample ADD CONSTRAINT FK_13B43D0427EB8A5 FOREIGN KEY (request_id) REFERENCES production.affinity_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_input_sample ADD CONSTRAINT FK_13B43D01B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_output_sample ADD CONSTRAINT FK_B48EA401427EB8A5 FOREIGN KEY (request_id) REFERENCES production.affinity_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_output_sample ADD CONSTRAINT FK_B48EA4011B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_project ADD CONSTRAINT FK_8F40EDFD9DD40A90 FOREIGN KEY (purification_request_id) REFERENCES production.affinity_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.affinity_purification_request_project ADD CONSTRAINT FK_8F40EDFD166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request ADD CONSTRAINT FK_40E45D79CCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request ADD CONSTRAINT FK_40E45D79E80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request ADD CONSTRAINT FK_40E45D79B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request ADD CONSTRAINT FK_40E45D79896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_input_sample ADD CONSTRAINT FK_F107673C427EB8A5 FOREIGN KEY (request_id) REFERENCES production.size_exclusion_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_input_sample ADD CONSTRAINT FK_F107673C1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_output_sample ADD CONSTRAINT FK_1DC23676427EB8A5 FOREIGN KEY (request_id) REFERENCES production.size_exclusion_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_output_sample ADD CONSTRAINT FK_1DC236761B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_project ADD CONSTRAINT FK_7FC032829DD40A90 FOREIGN KEY (purification_request_id) REFERENCES production.size_exclusion_purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_project ADD CONSTRAINT FK_7FC03282166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('DROP TABLE production.purification_request_project');
        $this->addSql('DROP TABLE production.purification_request_output_sample');
        $this->addSql('DROP TABLE production.purification_request_sample');
        $this->addSql('DROP TABLE production.purification_request');
        $this->addSql('ALTER TABLE production.dna ADD pipeline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.dna ADD pipeline_step INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.dna ADD CONSTRAINT FK_955A8DAE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_955A8DAE80B93 ON production.dna (pipeline_id)');
        $this->addSql('ALTER TABLE production.protein_request ADD pipeline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.protein_request ADD alias VARCHAR(300) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.protein_request ADD pipeline_step INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.protein_request ADD CONSTRAINT FK_98A0A493E80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_98A0A493E80B93 ON production.protein_request (pipeline_id)');
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        $requests = array(
            array(
                'name' => 'DNA',
                'entity' => 'AppBundle\\Entity\\Production\\DNA',
                'formType' => 'DNA',
            ),
            array(
                'name' => 'Protein',
                'entity' => 'AppBundle\\Entity\\Production\\ProteinRequest',
                'formType' => 'Protein',
            ),
            array(
                'name' => 'Affinity Purification',
                'entity' => 'AppBundle\\Entity\\Production\\Purification\\AffinityPurificationRequest',
                'formType' => 'AffinityPurification',
            ),
            array(
                'name' => 'Size Exclusion Purification',
                'entity' => 'AppBundle\\Entity\\Production\\Purification\\SizeExclusionPurificationRequest',
                'formType' => 'SizeExclusionPurification',
            ),
            array(
                'name' => 'Native Gel',
                'entity' => 'AppBudle\\Entity\\Production\\Analysis\\NativeGelRequest',
                'formType' => 'NativeGel',
            ),
            array(
                'name' => 'Western Gel',
                'entity' => 'AppBundle\\Entity\\Production\\Analysis\\WesternGelRequest',
                'formType' => 'WesternGel',
            ),
            array(
                'name' => 'SDS Page',
                'entity' => 'AppBundle\\Entity\\Production\\Analysis\\SdsPageRequest',
                'formType' => 'SdsPage',
            ),
            array(
                'name' => 'SEC Mals',
                'entity' => 'AppBundle\\Entity\\Production\\Analysis\\SecMalsRequest',
                'formType' => 'SecMals',
            ),
            array(
                'name' => 'SPR',
                'entity' => 'AppBundle\\Entity\\Production\\Analysis\\SprRequest',
                'formType' => 'Spr',
            )
        );

        foreach ($requests as $request) {
            $insertQuery = 'insert into production.pipeline_request (name, entity, form_type) VALUES (:name, :entity, :formType)';
            $insertStmt = $this->connection->prepare($insertQuery);
            $insertStmt->execute(array(
                'name' => $request['name'],
                'entity' => $request['entity'],
                'formType' => $request['formType'],
            ));
        }
    }


    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
