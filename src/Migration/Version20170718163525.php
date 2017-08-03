<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170718163525 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.protocol ADD updated_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE storage.protocol ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE storage.protocol ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE storage.protocol ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.protocol ALTER COLUMN notes DROP NOT NULL');
        $this->addSql('ALTER TABLE storage.protocol DROP createdat');
        $this->addSql('ALTER TABLE storage.protocol DROP updatedat');
        $this->addSql('ALTER TABLE storage.protocol DROP deletedat');
        $this->addSql('ALTER TABLE storage.protocol DROP archivedat');
        $this->addSql('ALTER TABLE storage.protocol RENAME COLUMN createdby TO created_by_id');
        $this->addSql('ALTER TABLE storage.protocol ADD CONSTRAINT FK_8CD3579DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.protocol ADD CONSTRAINT FK_8CD3579D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8CD3579DB03A8386 ON storage.protocol (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8CD3579D896DBBDE ON storage.protocol (updated_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
