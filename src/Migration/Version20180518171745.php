<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180518171745 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE production.spr_request_input_sample_id_seq CASCADE');
        $this->addSql('CREATE TABLE production.spr_request_binding_partner (id SERIAL NOT NULL, request_id INT NOT NULL, ligand_id INT NOT NULL, analyte_id INT NOT NULL, num_binding_sites INT NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1D863B1427EB8A5 ON production.spr_request_binding_partner (request_id)');
        $this->addSql('CREATE INDEX IDX_C1D863B11505C640 ON production.spr_request_binding_partner (ligand_id)');
        $this->addSql('CREATE INDEX IDX_C1D863B1ACDEDAAF ON production.spr_request_binding_partner (analyte_id)');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD CONSTRAINT FK_C1D863B1427EB8A5 FOREIGN KEY (request_id) REFERENCES production.spr_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD CONSTRAINT FK_C1D863B11505C640 FOREIGN KEY (ligand_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD CONSTRAINT FK_C1D863B1ACDEDAAF FOREIGN KEY (analyte_id) REFERENCES storage.sample (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE production.spr_request_input_sample');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
