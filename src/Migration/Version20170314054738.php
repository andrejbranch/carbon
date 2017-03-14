<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170314054738 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE storage.project_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE public.project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.project_sample_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.project (id INT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14971E52B03A8386 ON public.project (created_by_id)');
        $this->addSql('CREATE INDEX IDX_14971E52896DBBDE ON public.project (updated_by_id)');
        $this->addSql('CREATE TABLE storage.project_sample (id INT NOT NULL, project_id INT NOT NULL, sample_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_55F679A0166D1F9C ON storage.project_sample (project_id)');
        $this->addSql('CREATE INDEX IDX_55F679A01B1FEA20 ON storage.project_sample (sample_id)');
        $this->addSql('ALTER TABLE public.project ADD CONSTRAINT FK_14971E52B03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.project ADD CONSTRAINT FK_14971E52896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.project_sample ADD CONSTRAINT FK_55F679A0166D1F9C FOREIGN KEY (project_id) REFERENCES public.project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.project_sample ADD CONSTRAINT FK_55F679A01B1FEA20 FOREIGN KEY (sample_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE storage.project');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT FK_8017595D896DBBDE');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT FK_8017595DB03A8386');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.comment DROP CONSTRAINT FK_9AE8EC4FB03A8386');
        $this->addSql('ALTER TABLE cryoblock.comment ADD CONSTRAINT FK_9AE8EC4FB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_group DROP CONSTRAINT FK_36F61B73A76ED395');
        $this->addSql('ALTER TABLE cryoblock.user_group ADD CONSTRAINT FK_36F61B73A76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.project_sample DROP CONSTRAINT FK_55F679A0166D1F9C');
        $this->addSql('DROP SEQUENCE public.project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE storage.project_sample_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE cryoblock.attachment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.group_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.object_notification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.user_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cryoblock.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.division_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE storage.project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE storage.project (id INT NOT NULL, name VARCHAR(300) NOT NULL, description TEXT NOT NULL, notes TEXT NOT NULL, status VARCHAR(255) NOT NULL, id_created_by INT NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE public.project');
        $this->addSql('DROP TABLE storage.project_sample');
        $this->addSql('ALTER TABLE cryoblock.comment DROP CONSTRAINT fk_9ae8ec4fb03a8386');
        $this->addSql('ALTER TABLE cryoblock.comment ADD CONSTRAINT fk_9ae8ec4fb03a8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cryoblock.user_group DROP CONSTRAINT fk_36f61b73a76ed395');
        $this->addSql('ALTER TABLE cryoblock.user_group ADD CONSTRAINT fk_36f61b73a76ed395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT fk_8017595db03a8386');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT fk_8017595d896dbbde');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT fk_8017595db03a8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT fk_8017595d896dbbde FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
