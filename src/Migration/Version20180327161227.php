<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180327161227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.sample ADD volume_units VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample ALTER catalog_id SET NOT NULL');
        $this->addSql('ALTER TABLE storage.sample ALTER volume TYPE NUMERIC(20, 3)');
        $this->addSql('ALTER TABLE storage.sample_type ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample_type ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample_type ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE storage.sample_type ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE storage.sample_type ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');

        $this->addSql('ALTER TABLE storage.sample_type ADD CONSTRAINT FK_859741DEB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample_type ADD CONSTRAINT FK_859741DE896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_859741DEB03A8386 ON storage.sample_type (created_by_id)');
        $this->addSql('CREATE INDEX IDX_859741DE896DBBDE ON storage.sample_type (updated_by_id)');

        $this->addSql('UPDATE storage.sample_type SET created_by_id = 1, updated_by_id = 1');

        $this->addSql('ALTER TABLE storage.sample_type ALTER created_by_id SET NOT NULL');
        $this->addSql('ALTER TABLE storage.sample_type ALTER updated_by_id SET NOT NULL');
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
