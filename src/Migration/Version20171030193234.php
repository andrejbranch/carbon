<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171030193234 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE production.dna_output_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.dna_request_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.protein_request_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.purification_request_sample_id_seq CASCADE');

        $this->addSql('CREATE SEQUENCE production.dna_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('CREATE TABLE production.dna_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C16626427EB8A5 ON production.dna_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_A3C166261B1FEA20 ON production.dna_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.dna_request_output_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0F2090D427EB8A5 ON production.dna_request_output_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_E0F2090D1B1FEA20 ON production.dna_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.protein_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_96B28F06427EB8A5 ON production.protein_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_96B28F061B1FEA20 ON production.protein_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.purification_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B44A80427EB8A5 ON production.purification_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_2B44A801B1FEA20 ON production.purification_request_input_sample (sample_id)');

        $this->addSql('ALTER TABLE production.dna_request_input_sample ADD CONSTRAINT FK_A3C16626427EB8A5 FOREIGN KEY (request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_input_sample ADD CONSTRAINT FK_A3C166261B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_output_sample ADD CONSTRAINT FK_E0F2090D427EB8A5 FOREIGN KEY (request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_output_sample ADD CONSTRAINT FK_E0F2090D1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_input_sample ADD CONSTRAINT FK_96B28F06427EB8A5 FOREIGN KEY (request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_input_sample ADD CONSTRAINT FK_96B28F061B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_input_sample ADD CONSTRAINT FK_2B44A80427EB8A5 FOREIGN KEY (request_id) REFERENCES production.purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_input_sample ADD CONSTRAINT FK_2B44A801B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('DROP TABLE production.dna_request_sample');
        $this->addSql('DROP TABLE production.protein_request_sample');
        $this->addSql('DROP TABLE production.dna_output_sample');
        $this->addSql('DROP TABLE production.purification_request_sample');

        $this->addSql('ALTER TABLE production.protein_request_output_sample DROP CONSTRAINT fk_dba95a2c2fb92716');
        $this->addSql('ALTER TABLE production.protein_request_output_sample RENAME COLUMN protein_request_id TO request_id');
        $this->addSql('ALTER TABLE production.protein_request_output_sample ADD CONSTRAINT FK_DBA95A2C427EB8A5 FOREIGN KEY (request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DBA95A2C427EB8A5 ON production.protein_request_output_sample (request_id)');
        $this->addSql('ALTER TABLE production.purification_request_output_sample DROP CONSTRAINT fk_dfe67afc9dd40a90');
        $this->addSql('ALTER TABLE production.purification_request_output_sample RENAME COLUMN purification_request_id TO request_id');
        $this->addSql('ALTER TABLE production.purification_request_output_sample ADD CONSTRAINT FK_DFE67AFC427EB8A5 FOREIGN KEY (request_id) REFERENCES production.purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DFE67AFC427EB8A5 ON production.purification_request_output_sample (request_id)');


        $this->addSql('CREATE SEQUENCE production.analysis_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.analysis_request_input_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.analysis_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.analysis_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production.analysis_request (id INT NOT NULL, pipeline_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, protocol_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, pipeline_step INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, notes TEXT DEFAULT NULL, alias VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E9DFFA8DE80B93 ON production.analysis_request (pipeline_id)');
        $this->addSql('CREATE INDEX IDX_E9DFFA8DB03A8386 ON production.analysis_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E9DFFA8D896DBBDE ON production.analysis_request (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_E9DFFA8DCCD59258 ON production.analysis_request (protocol_id)');
        $this->addSql('CREATE TABLE production.analysis_request_input_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7948E4ED427EB8A5 ON production.analysis_request_input_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_7948E4ED1B1FEA20 ON production.analysis_request_input_sample (sample_id)');
        $this->addSql('CREATE TABLE production.analysis_request_output_sample (id INT NOT NULL, request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EC9E9BB7427EB8A5 ON production.analysis_request_output_sample (request_id)');
        $this->addSql('CREATE INDEX IDX_EC9E9BB71B1FEA20 ON production.analysis_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.analysis_request_project (id INT NOT NULL, analysis_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9567CF5B8480EA0E ON production.analysis_request_project (analysis_request_id)');
        $this->addSql('CREATE INDEX IDX_9567CF5B166D1F9C ON production.analysis_request_project (project_id)');
        $this->addSql('ALTER TABLE production.analysis_request ADD CONSTRAINT FK_E9DFFA8DE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request ADD CONSTRAINT FK_E9DFFA8DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request ADD CONSTRAINT FK_E9DFFA8D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request ADD CONSTRAINT FK_E9DFFA8DCCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_input_sample ADD CONSTRAINT FK_7948E4ED427EB8A5 FOREIGN KEY (request_id) REFERENCES production.analysis_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_input_sample ADD CONSTRAINT FK_7948E4ED1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_output_sample ADD CONSTRAINT FK_EC9E9BB7427EB8A5 FOREIGN KEY (request_id) REFERENCES production.analysis_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_output_sample ADD CONSTRAINT FK_EC9E9BB71B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_project ADD CONSTRAINT FK_9567CF5B8480EA0E FOREIGN KEY (analysis_request_id) REFERENCES production.analysis_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.analysis_request_project ADD CONSTRAINT FK_9567CF5B166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
