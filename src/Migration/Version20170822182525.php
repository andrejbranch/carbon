<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170822182525 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE production.dna_request_project DROP CONSTRAINT fk_35ad7753166d1f9c');
        $this->addSql('CREATE SEQUENCE production.dna_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production.dna_output_sample (id INT NOT NULL, dna_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A4B5CF6499A764D ON production.dna_output_sample (dna_request_id)');
        $this->addSql('CREATE INDEX IDX_6A4B5CF61B1FEA20 ON production.dna_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.protein_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, volume NUMERIC(3, 0) DEFAULT NULL, notes TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, volume_units VARCHAR(15) DEFAULT NULL, status VARCHAR(255) NOT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98A0A493CCD59258 ON production.protein_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_98A0A493B03A8386 ON production.protein_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_98A0A493896DBBDE ON production.protein_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.protein_request_output_sample (id INT NOT NULL, protein_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DBA95A2C2FB92716 ON production.protein_request_output_sample (protein_request_id)');
        $this->addSql('CREATE INDEX IDX_DBA95A2C1B1FEA20 ON production.protein_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.protein_request_project (id INT NOT NULL, protein_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B17A08C32FB92716 ON production.protein_request_project (protein_request_id)');
        $this->addSql('CREATE INDEX IDX_B17A08C3166D1F9C ON production.protein_request_project (project_id)');
        $this->addSql('CREATE TABLE production.protein_request_sample (id INT NOT NULL, protein_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5C46F8C42FB92716 ON production.protein_request_sample (protein_request_id)');
        $this->addSql('CREATE INDEX IDX_5C46F8C41B1FEA20 ON production.protein_request_sample (sample_id)');
        $this->addSql('CREATE TABLE production.purification_request (id INT NOT NULL, protocol_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, volume NUMERIC(3, 0) DEFAULT NULL, notes TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, volume_units VARCHAR(15) DEFAULT NULL, status VARCHAR(255) NOT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E09BEF9CCD59258 ON production.purification_request (protocol_id)');
        $this->addSql('CREATE INDEX IDX_E09BEF9B03A8386 ON production.purification_request (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E09BEF9896DBBDE ON production.purification_request (updated_by_id)');
        $this->addSql('CREATE TABLE production.purification_request_output_sample (id INT NOT NULL, purification_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DFE67AFC9DD40A90 ON production.purification_request_output_sample (purification_request_id)');
        $this->addSql('CREATE INDEX IDX_DFE67AFC1B1FEA20 ON production.purification_request_output_sample (sample_id)');
        $this->addSql('CREATE TABLE production.purification_request_project (id INT NOT NULL, purification_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53AAE5A69DD40A90 ON production.purification_request_project (purification_request_id)');
        $this->addSql('CREATE INDEX IDX_53AAE5A6166D1F9C ON production.purification_request_project (project_id)');
        $this->addSql('CREATE TABLE production.purification_request_sample (id INT NOT NULL, purification_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_34D1890D9DD40A90 ON production.purification_request_sample (purification_request_id)');
        $this->addSql('CREATE INDEX IDX_34D1890D1B1FEA20 ON production.purification_request_sample (sample_id)');
        $this->addSql('ALTER TABLE production.dna_output_sample ADD CONSTRAINT FK_6A4B5CF6499A764D FOREIGN KEY (dna_request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_output_sample ADD CONSTRAINT FK_6A4B5CF61B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request ADD CONSTRAINT FK_98A0A493CCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request ADD CONSTRAINT FK_98A0A493B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request ADD CONSTRAINT FK_98A0A493896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_output_sample ADD CONSTRAINT FK_DBA95A2C2FB92716 FOREIGN KEY (protein_request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_output_sample ADD CONSTRAINT FK_DBA95A2C1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_project ADD CONSTRAINT FK_B17A08C32FB92716 FOREIGN KEY (protein_request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_project ADD CONSTRAINT FK_B17A08C3166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_sample ADD CONSTRAINT FK_5C46F8C42FB92716 FOREIGN KEY (protein_request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_sample ADD CONSTRAINT FK_5C46F8C41B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request ADD CONSTRAINT FK_E09BEF9CCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request ADD CONSTRAINT FK_E09BEF9B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request ADD CONSTRAINT FK_E09BEF9896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_output_sample ADD CONSTRAINT FK_DFE67AFC9DD40A90 FOREIGN KEY (purification_request_id) REFERENCES production.purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_output_sample ADD CONSTRAINT FK_DFE67AFC1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_project ADD CONSTRAINT FK_53AAE5A69DD40A90 FOREIGN KEY (purification_request_id) REFERENCES production.purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_project ADD CONSTRAINT FK_53AAE5A6166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_sample ADD CONSTRAINT FK_34D1890D9DD40A90 FOREIGN KEY (purification_request_id) REFERENCES production.purification_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.purification_request_sample ADD CONSTRAINT FK_34D1890D1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE production.dna ADD alias VARCHAR(300) DEFAULT NULL');
        $this->addSql('CREATE INDEX dna_alias_idx ON production.dna (alias)');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
