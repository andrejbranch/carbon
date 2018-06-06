<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180518191808 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD ligand_mw NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD analyte_mw NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD concentration NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_on NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_off NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_d NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD r_max_fit NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD r_max_exp NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD r_max_ratio NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD signal_level NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD signal_ratio NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD chi2 NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD norm_chi2 NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD r_max_equil NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_d_equil NUMERIC(20, 3) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD r_max BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_on_in_range BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_off_in_range BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD capture VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD curve_fit VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD equil BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE production.spr_request_binding_partner ADD k_d_fix NUMERIC(20, 3) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
