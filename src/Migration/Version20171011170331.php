<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171011170331 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE production.pipeline (id SERIAL NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6253B5ABB03A8386 ON production.pipeline (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6253B5AB896DBBDE ON production.pipeline (updated_by_id)');
        $this->addSql('CREATE TABLE production.pipeline_request (id SERIAL NOT NULL, name VARCHAR(300) NOT NULL, entity VARCHAR(300) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE production.pipeline ADD CONSTRAINT FK_6253B5ABB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline ADD CONSTRAINT FK_6253B5AB896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock.cryoblock_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE production.pipeline_input_request (id SERIAL NOT NULL, from_pipeline_request_id INT DEFAULT NULL, to_pipeline_request_id INT DEFAULT NULL, from_request_id INT NOT NULL, to_request_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_799F2688B793AF5E ON production.pipeline_input_request (from_pipeline_request_id)');
        $this->addSql('CREATE INDEX IDX_799F2688F28F0270 ON production.pipeline_input_request (to_pipeline_request_id)');

        $this->addSql('ALTER TABLE production.pipeline_input_request ADD CONSTRAINT FK_799F2688B793AF5E FOREIGN KEY (from_pipeline_request_id) REFERENCES production.pipeline_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production.pipeline_input_request ADD CONSTRAINT FK_799F2688F28F0270 FOREIGN KEY (to_pipeline_request_id) REFERENCES production.pipeline_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE production.dna ADD pipeline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.dna ADD pipeline_step INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.dna ADD CONSTRAINT FK_955A8DAE80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE production.protein_request ADD pipeline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.protein_request ADD pipeline_step INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.protein_request ADD CONSTRAINT FK_98A0A493E80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE production.purification_request ADD pipeline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.purification_request ADD pipeline_step INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production.purification_request ADD CONSTRAINT FK_E09BEF9E80B93 FOREIGN KEY (pipeline_id) REFERENCES production.pipeline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('ALTER TABLE production.protein_request ADD alias VARCHAR(300) DEFAULT NULL');
        $this->addSql('ALTER TABLE production.purification_request ADD alias VARCHAR(300) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        $requests = array(
            array(
                'name' => 'DNA',
                'entity' => 'AppBundle\\Entity\\Production\\DNA',
            ),
            array(
                'name' => 'Protein',
                'entity' => 'AppBundle\\Entity\\Production\\ProteinRequest',
            ),
            array(
                'name' => 'Purification',
                'entity' => 'AppBundle\\Entity\\Production\\PurificationRequest',
            ),
            array(
                'name' => 'Analysis',
                'entity' => 'AppBundle\\Entity\\Production\\AnalysisRequest',
            )
        );

        foreach ($requests as $request) {
            $insertQuery = 'insert into production.pipeline_request (name, entity) VALUES (:name, :entity)';
            $insertStmt = $this->connection->prepare($insertQuery);
            $insertStmt->execute(array(
                'name' => $request['name'],
                'entity' => $request['entity'],
            ));
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
