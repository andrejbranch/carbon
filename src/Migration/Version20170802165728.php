<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170802165728 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE storage.catalog (id SERIAL NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(300) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CEA902BB03A8386 ON storage.catalog (created_by_id)');
        $this->addSql('CREATE INDEX IDX_CEA902B896DBBDE ON storage.catalog (updated_by_id)');
        $this->addSql('CREATE INDEX catalog_name_idx ON storage.catalog (name)');

        $this->addSql('ALTER TABLE storage.catalog ADD CONSTRAINT FK_CEA902BB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.catalog ADD CONSTRAINT FK_CEA902B896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE storage.division ADD allow_all_sample_types BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.division ADD allow_all_storage_containers BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample ADD lot VARCHAR(300) DEFAULT NULL');
        $this->addSql('CREATE INDEX sample_name_idx ON storage.sample (name)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
