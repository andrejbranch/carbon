<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180514153739 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE cryoblock.object_notification_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.dna_output_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.dna_request_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.protein_request_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.purification_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.purification_request_output_sample_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.purification_request_project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE production.purification_request_sample_id_seq CASCADE');
        $this->addSql('CREATE TABLE storage.sample_tag (id SERIAL NOT NULL, tag_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FCD36B8FBAD26311 ON storage.sample_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_FCD36B8F1B1FEA20 ON storage.sample_tag (sample_id)');
        $this->addSql('CREATE TABLE storage.tag (id SERIAL NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B8D4E76B03A8386 ON storage.tag (created_by_id)');
        $this->addSql('CREATE INDEX IDX_4B8D4E76896DBBDE ON storage.tag (updated_by_id)');
        $this->addSql('CREATE TABLE cryoblock.group_object_notification (id SERIAL NOT NULL, on_create_group_id INT DEFAULT NULL, on_update_group_id INT DEFAULT NULL, on_delete_group_id INT DEFAULT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, entity VARCHAR(300) NOT NULL, url VARCHAR(300) NOT NULL, object_description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51D8033B51CD427 ON cryoblock.group_object_notification (on_create_group_id)');
        $this->addSql('CREATE INDEX IDX_51D8033EF7C82B2 ON cryoblock.group_object_notification (on_update_group_id)');
        $this->addSql('CREATE INDEX IDX_51D8033A9F17C06 ON cryoblock.group_object_notification (on_delete_group_id)');
        $this->addSql('CREATE INDEX IDX_51D8033B03A8386 ON cryoblock.group_object_notification (created_by_id)');
        $this->addSql('CREATE INDEX IDX_51D8033896DBBDE ON cryoblock.group_object_notification (updated_by_id)');
        $this->addSql('CREATE TABLE cryoblock.user_object_notification (id SERIAL NOT NULL, user_id INT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, entity VARCHAR(300) NOT NULL, entity_id INT DEFAULT NULL, url VARCHAR(300) NOT NULL, object_description VARCHAR(255) NOT NULL, on_create BOOLEAN DEFAULT NULL, on_update BOOLEAN DEFAULT NULL, on_delete BOOLEAN DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_638348DA76ED395 ON cryoblock.user_object_notification (user_id)');
        $this->addSql('CREATE INDEX IDX_638348DB03A8386 ON cryoblock.user_object_notification (created_by_id)');
        $this->addSql('CREATE INDEX IDX_638348D896DBBDE ON cryoblock.user_object_notification (updated_by_id)');
        $this->addSql('ALTER TABLE storage.sample_tag ADD CONSTRAINT FK_FCD36B8FBAD26311 FOREIGN KEY (tag_id) REFERENCES storage.tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample_tag ADD CONSTRAINT FK_FCD36B8F1B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.tag ADD CONSTRAINT FK_4B8D4E76B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.tag ADD CONSTRAINT FK_4B8D4E76896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_object_notification ADD CONSTRAINT FK_51D8033B51CD427 FOREIGN KEY (on_create_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_object_notification ADD CONSTRAINT FK_51D8033EF7C82B2 FOREIGN KEY (on_update_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_object_notification ADD CONSTRAINT FK_51D8033A9F17C06 FOREIGN KEY (on_delete_group_id) REFERENCES cryoblock.carbon_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_object_notification ADD CONSTRAINT FK_51D8033B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.group_object_notification ADD CONSTRAINT FK_51D8033896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_object_notification ADD CONSTRAINT FK_638348DA76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_object_notification ADD CONSTRAINT FK_638348DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_object_notification ADD CONSTRAINT FK_638348D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE production.dna_request_sample');
        $this->addSql('DROP TABLE production.protein_request_sample');
        $this->addSql('DROP TABLE production.dna_output_sample');
        $this->addSql('DROP TABLE cryoblock.object_notification');
        $this->addSql('SELECT setval(\'production.native_gel_request_id_seq\', (SELECT MAX(id) FROM production.native_gel_request))');
        $this->addSql('ALTER TABLE production.native_gel_request ALTER id SET DEFAULT nextval(\'production.native_gel_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.native_gel_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.native_gel_request_input_sample))');
        $this->addSql('ALTER TABLE production.native_gel_request_input_sample ALTER id SET DEFAULT nextval(\'production.native_gel_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.native_gel_request_project_id_seq\', (SELECT MAX(id) FROM production.native_gel_request_project))');
        $this->addSql('ALTER TABLE production.native_gel_request_project ALTER id SET DEFAULT nextval(\'production.native_gel_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.sds_page_request_id_seq\', (SELECT MAX(id) FROM production.sds_page_request))');
        $this->addSql('ALTER TABLE production.sds_page_request ALTER id SET DEFAULT nextval(\'production.sds_page_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.sds_page_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.sds_page_request_input_sample))');
        $this->addSql('ALTER TABLE production.sds_page_request_input_sample ALTER id SET DEFAULT nextval(\'production.sds_page_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.sds_page_request_project_id_seq\', (SELECT MAX(id) FROM production.sds_page_request_project))');
        $this->addSql('ALTER TABLE production.sds_page_request_project ALTER id SET DEFAULT nextval(\'production.sds_page_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.sec_mals_request_id_seq\', (SELECT MAX(id) FROM production.sec_mals_request))');
        $this->addSql('ALTER TABLE production.sec_mals_request ALTER id SET DEFAULT nextval(\'production.sec_mals_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.sec_mals_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.sec_mals_request_input_sample))');
        $this->addSql('ALTER TABLE production.sec_mals_request_input_sample ALTER id SET DEFAULT nextval(\'production.sec_mals_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.sec_mals_request_project_id_seq\', (SELECT MAX(id) FROM production.sec_mals_request_project))');
        $this->addSql('ALTER TABLE production.sec_mals_request_project ALTER id SET DEFAULT nextval(\'production.sec_mals_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.spr_request_id_seq\', (SELECT MAX(id) FROM production.spr_request))');
        $this->addSql('ALTER TABLE production.spr_request ALTER id SET DEFAULT nextval(\'production.spr_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.spr_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.spr_request_input_sample))');
        $this->addSql('ALTER TABLE production.spr_request_input_sample ALTER id SET DEFAULT nextval(\'production.spr_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.spr_request_project_id_seq\', (SELECT MAX(id) FROM production.spr_request_project))');
        $this->addSql('ALTER TABLE production.spr_request_project ALTER id SET DEFAULT nextval(\'production.spr_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.western_gel_request_id_seq\', (SELECT MAX(id) FROM production.western_gel_request))');
        $this->addSql('ALTER TABLE production.western_gel_request ALTER id SET DEFAULT nextval(\'production.western_gel_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.western_gel_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.western_gel_request_input_sample))');
        $this->addSql('ALTER TABLE production.western_gel_request_input_sample ALTER id SET DEFAULT nextval(\'production.western_gel_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.western_gel_request_project_id_seq\', (SELECT MAX(id) FROM production.western_gel_request_project))');
        $this->addSql('ALTER TABLE production.western_gel_request_project ALTER id SET DEFAULT nextval(\'production.western_gel_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.dna_id_seq\', (SELECT MAX(id) FROM production.dna))');
        $this->addSql('ALTER TABLE production.dna ALTER id SET DEFAULT nextval(\'production.dna_id_seq\')');
        $this->addSql('SELECT setval(\'production.dna_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.dna_request_input_sample))');
        $this->addSql('ALTER TABLE production.dna_request_input_sample ALTER id SET DEFAULT nextval(\'production.dna_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.dna_request_output_sample_id_seq\', (SELECT MAX(id) FROM production.dna_request_output_sample))');
        $this->addSql('ALTER TABLE production.dna_request_output_sample ALTER id SET DEFAULT nextval(\'production.dna_request_output_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.dna_request_project_id_seq\', (SELECT MAX(id) FROM production.dna_request_project))');
        $this->addSql('ALTER TABLE production.dna_request_project ALTER id SET DEFAULT nextval(\'production.dna_request_project_id_seq\')');
        $this->addSql('ALTER TABLE production.dna_request_project ADD CONSTRAINT FK_35AD7753166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('SELECT setval(\'production.protein_request_id_seq\', (SELECT MAX(id) FROM production.protein_request))');
        $this->addSql('ALTER TABLE production.protein_request ALTER id SET DEFAULT nextval(\'production.protein_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.protein_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.protein_request_input_sample))');
        $this->addSql('ALTER TABLE production.protein_request_input_sample ALTER id SET DEFAULT nextval(\'production.protein_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.protein_request_output_sample_id_seq\', (SELECT MAX(id) FROM production.protein_request_output_sample))');
        $this->addSql('ALTER TABLE production.protein_request_output_sample ALTER id SET DEFAULT nextval(\'production.protein_request_output_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.protein_request_project_id_seq\', (SELECT MAX(id) FROM production.protein_request_project))');
        $this->addSql('ALTER TABLE production.protein_request_project ALTER id SET DEFAULT nextval(\'production.protein_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.affinity_purification_request_id_seq\', (SELECT MAX(id) FROM production.affinity_purification_request))');
        $this->addSql('ALTER TABLE production.affinity_purification_request ALTER id SET DEFAULT nextval(\'production.affinity_purification_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.affinity_purification_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.affinity_purification_request_input_sample))');
        $this->addSql('ALTER TABLE production.affinity_purification_request_input_sample ALTER id SET DEFAULT nextval(\'production.affinity_purification_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.affinity_purification_request_output_sample_id_seq\', (SELECT MAX(id) FROM production.affinity_purification_request_output_sample))');
        $this->addSql('ALTER TABLE production.affinity_purification_request_output_sample ALTER id SET DEFAULT nextval(\'production.affinity_purification_request_output_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.affinity_purification_request_project_id_seq\', (SELECT MAX(id) FROM production.affinity_purification_request_project))');
        $this->addSql('ALTER TABLE production.affinity_purification_request_project ALTER id SET DEFAULT nextval(\'production.affinity_purification_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'production.size_exclusion_purification_request_id_seq\', (SELECT MAX(id) FROM production.size_exclusion_purification_request))');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request ALTER id SET DEFAULT nextval(\'production.size_exclusion_purification_request_id_seq\')');
        $this->addSql('SELECT setval(\'production.size_exclusion_purification_request_input_sample_id_seq\', (SELECT MAX(id) FROM production.size_exclusion_purification_request_input_sample))');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_input_sample ALTER id SET DEFAULT nextval(\'production.size_exclusion_purification_request_input_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.size_exclusion_purification_request_output_sample_id_seq\', (SELECT MAX(id) FROM production.size_exclusion_purification_request_output_sample))');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_output_sample ALTER id SET DEFAULT nextval(\'production.size_exclusion_purification_request_output_sample_id_seq\')');
        $this->addSql('SELECT setval(\'production.size_exclusion_purification_request_project_id_seq\', (SELECT MAX(id) FROM production.size_exclusion_purification_request_project))');
        $this->addSql('ALTER TABLE production.size_exclusion_purification_request_project ALTER id SET DEFAULT nextval(\'production.size_exclusion_purification_request_project_id_seq\')');
        $this->addSql('SELECT setval(\'project_id_seq\', (SELECT MAX(id) FROM project))');
        $this->addSql('ALTER TABLE project ALTER id SET DEFAULT nextval(\'project_id_seq\')');
        $this->addSql('ALTER TABLE project ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE project ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE storage.division ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE storage.division ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE storage.division ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division ALTER is_public_edit DROP DEFAULT');
        $this->addSql('ALTER TABLE storage.division ALTER is_public_view DROP DEFAULT');
        $this->addSql('ALTER TABLE storage.division ADD CONSTRAINT FK_5404ACC5B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division ADD CONSTRAINT FK_5404ACC5896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5404ACC5B03A8386 ON storage.division (created_by_id)');
        $this->addSql('CREATE INDEX IDX_5404ACC5896DBBDE ON storage.division (updated_by_id)');
        $this->addSql('ALTER TABLE storage.division_editor ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division_group_editor ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('SELECT setval(\'storage.division_group_editor_id_seq\', (SELECT MAX(id) FROM storage.division_group_editor))');
        $this->addSql('ALTER TABLE storage.division_group_editor ALTER id SET DEFAULT nextval(\'storage.division_group_editor_id_seq\')');
        $this->addSql('ALTER TABLE storage.division_group_viewer ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('SELECT setval(\'storage.division_group_viewer_id_seq\', (SELECT MAX(id) FROM storage.division_group_viewer))');
        $this->addSql('ALTER TABLE storage.division_group_viewer ALTER id SET DEFAULT nextval(\'storage.division_group_viewer_id_seq\')');
        $this->addSql('ALTER TABLE storage.division_sample_type ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('SELECT setval(\'storage.division_sample_type_id_seq\', (SELECT MAX(id) FROM storage.division_sample_type))');
        $this->addSql('ALTER TABLE storage.division_sample_type ALTER id SET DEFAULT nextval(\'storage.division_sample_type_id_seq\')');
        $this->addSql('ALTER TABLE storage.division_storage_container ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('SELECT setval(\'storage.division_storage_container_id_seq\', (SELECT MAX(id) FROM storage.division_storage_container))');
        $this->addSql('ALTER TABLE storage.division_storage_container ALTER id SET DEFAULT nextval(\'storage.division_storage_container_id_seq\')');
        $this->addSql('ALTER TABLE storage.division_viewer ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('SELECT setval(\'storage.division_viewer_id_seq\', (SELECT MAX(id) FROM storage.division_viewer))');
        $this->addSql('ALTER TABLE storage.division_viewer ALTER id SET DEFAULT nextval(\'storage.division_viewer_id_seq\')');
        $this->addSql('SELECT setval(\'storage.project_sample_id_seq\', (SELECT MAX(id) FROM storage.project_sample))');
        $this->addSql('ALTER TABLE storage.project_sample ALTER id SET DEFAULT nextval(\'storage.project_sample_id_seq\')');
        $this->addSql('SELECT setval(\'storage.protocol_id_seq\', (SELECT MAX(id) FROM storage.protocol))');
        $this->addSql('ALTER TABLE storage.protocol ALTER id SET DEFAULT nextval(\'storage.protocol_id_seq\')');
        $this->addSql('SELECT setval(\'storage.sample_id_seq\', (SELECT MAX(id) FROM storage.sample))');
        $this->addSql('ALTER TABLE storage.sample ALTER id SET DEFAULT nextval(\'storage.sample_id_seq\')');
        $this->addSql('SELECT setval(\'storage.sample_linked_sample_id_seq\', (SELECT MAX(id) FROM storage.sample_linked_sample))');
        $this->addSql('ALTER TABLE storage.sample_linked_sample ALTER id SET DEFAULT nextval(\'storage.sample_linked_sample_id_seq\')');
        $this->addSql('SELECT setval(\'storage.sample_type_id_seq\', (SELECT MAX(id) FROM storage.sample_type))');
        $this->addSql('ALTER TABLE storage.sample_type ALTER id SET DEFAULT nextval(\'storage.sample_type_id_seq\')');
        $this->addSql('SELECT setval(\'storage.storage_container_id_seq\', (SELECT MAX(id) FROM storage.storage_container))');
        $this->addSql('ALTER TABLE storage.storage_container ALTER id SET DEFAULT nextval(\'storage.storage_container_id_seq\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
    }
}
