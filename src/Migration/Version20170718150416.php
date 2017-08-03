<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170718150416 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('create schema if not exists production');

        $this->addSql('CREATE SEQUENCE production.dna_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production.dna (id INT NOT NULL, protocol_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, volume NUMERIC(3, 0) DEFAULT NULL, notes TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, volume_units VARCHAR(15) DEFAULT NULL, status VARCHAR(255) NOT NULL, concentration NUMERIC(20, 3) DEFAULT NULL, concentration_units VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_955A8DACCD59258 ON production.dna (protocol_id)');
        $this->addSql('CREATE INDEX IDX_955A8DAB03A8386 ON production.dna (created_by_id)');
        $this->addSql('CREATE INDEX IDX_955A8DA896DBBDE ON production.dna (updated_by_id)');
        $this->addSql('CREATE TABLE production.dna_request_project (id INT NOT NULL, dna_request_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_35AD7753499A764D ON production.dna_request_project (dna_request_id)');
        $this->addSql('CREATE INDEX IDX_35AD7753166D1F9C ON production.dna_request_project (project_id)');
        $this->addSql('CREATE TABLE production.dna_request_sample (id INT NOT NULL, dna_request_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3578B6D7499A764D ON production.dna_request_sample (dna_request_id)');
        $this->addSql('CREATE INDEX IDX_3578B6D71B1FEA20 ON production.dna_request_sample (sample_id)');
        $this->addSql('ALTER TABLE production.dna ADD CONSTRAINT FK_955A8DACCD59258 FOREIGN KEY (protocol_id) REFERENCES storage.protocol (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna ADD CONSTRAINT FK_955A8DAB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna ADD CONSTRAINT FK_955A8DA896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_project ADD CONSTRAINT FK_35AD7753499A764D FOREIGN KEY (dna_request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_project ADD CONSTRAINT FK_35AD7753166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_sample ADD CONSTRAINT FK_3578B6D7499A764D FOREIGN KEY (dna_request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_sample ADD CONSTRAINT FK_3578B6D71B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
