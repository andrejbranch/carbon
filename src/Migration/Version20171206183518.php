<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171206183518 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE production.protein_request_output_sample DROP CONSTRAINT fk_dba95a2c2fb92716');
        $this->addSql('ALTER TABLE production.protein_request_output_sample RENAME COLUMN protein_request_id TO request_id');
        $this->addSql('ALTER TABLE production.protein_request_output_sample ADD CONSTRAINT FK_DBA95A2C427EB8A5 FOREIGN KEY (request_id) REFERENCES production.protein_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DBA95A2C427EB8A5 ON production.protein_request_output_sample (request_id)');
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
