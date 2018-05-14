<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180327163950 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE public.project ADD COLUMN deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE production.native_gel_request_project DROP CONSTRAINT FK_36854C0166D1F9C');
        $this->addSql('ALTER TABLE production.sds_page_request_project DROP CONSTRAINT FK_C88F3643166D1F9C');
        $this->addSql('ALTER TABLE production.sec_mals_request_project DROP CONSTRAINT FK_E12E6645166D1F9C');
        $this->addSql('ALTER TABLE production.spr_request_project DROP CONSTRAINT FK_1F944B7A166D1F9C');
        $this->addSql('ALTER TABLE production.western_gel_request_project DROP CONSTRAINT FK_7B197B71166D1F9C');
        $this->addSql('ALTER TABLE production.dna_request_project DROP CONSTRAINT FK_35AD7753166D1F9C');
        $this->addSql('ALTER TABLE production.protein_request_project DROP CONSTRAINT FK_B17A08C3166D1F9C');
        $this->addSql('ALTER TABLE production.affinity_purification_request_project DROP CONSTRAINT FK_8F40EDFD166D1F9C');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_project DROP CONSTRAINT FK_7FC03282166D1F9C');
        $this->addSql('ALTER TABLE storage.project_sample DROP CONSTRAINT FK_55F679A0166D1F9C');
        $this->addSql('DROP SEQUENCE public.project_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE cryoblock.attachment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.group_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.object_notification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.user_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.dna_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.protein_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_output_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.purification_request_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.catalog_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.division_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.parent_catalog_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.pipeline_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.pipeline_input_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE production.pipeline_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production.dna_request_sample (id INT NOT NULL, sample_id INT NOT NULL, dna_request_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_3578b6d7499a764d ON production.dna_request_sample (dna_request_id)');
        $this->addSql('CREATE INDEX idx_3578b6d71b1fea20 ON production.dna_request_sample (sample_id)');
        $this->addSql('CREATE TABLE production.protein_request_sample (id INT NOT NULL, sample_id INT NOT NULL, protein_request_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_5c46f8c42fb92716 ON production.protein_request_sample (protein_request_id)');
        $this->addSql('CREATE INDEX idx_5c46f8c41b1fea20 ON production.protein_request_sample (sample_id)');
        $this->addSql('CREATE TABLE production.dna_output_sample (id INT NOT NULL, sample_id INT NOT NULL, dna_request_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_6a4b5cf6499a764d ON production.dna_output_sample (dna_request_id)');
        $this->addSql('CREATE INDEX idx_6a4b5cf61b1fea20 ON production.dna_output_sample (sample_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, updated_by_id INT NOT NULL, created_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_14971e52b03a8386 ON project (created_by_id)');
        $this->addSql('CREATE INDEX idx_14971e52896dbbde ON project (updated_by_id)');
        $this->addSql('ALTER TABLE production.dna_request_sample ADD CONSTRAINT fk_3578b6d71b1fea20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_request_sample ADD CONSTRAINT fk_3578b6d7499a764d FOREIGN KEY (dna_request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_sample ADD CONSTRAINT fk_5c46f8c41b1fea20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.protein_request_sample ADD CONSTRAINT fk_5c46f8c42fb92716 FOREIGN KEY (protein_request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_output_sample ADD CONSTRAINT fk_6a4b5cf61b1fea20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.dna_output_sample ADD CONSTRAINT fk_6a4b5cf6499a764d FOREIGN KEY (dna_request_id) REFERENCES production.dna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_14971e52896dbbde FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_14971e52b03a8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE public.project');
        $this->addSql('ALTER TABLE storage.division ALTER is_public_edit SET DEFAULT \'false\'');
        $this->addSql('ALTER TABLE storage.division ALTER is_public_view SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE storage.division ALTER allow_all_sample_types DROP NOT NULL');
        $this->addSql('ALTER TABLE storage.division ALTER allow_all_storage_containers DROP NOT NULL');
    }
}
