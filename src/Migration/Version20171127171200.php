<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171127171200 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE storage.parent_catalog (id SERIAL NOT NULL, parent_catalog_id INT NOT NULL, child_catalog_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA3DA2288B7FE2AC ON storage.parent_catalog (parent_catalog_id)');
        $this->addSql('CREATE INDEX IDX_DA3DA22828E39897 ON storage.parent_catalog (child_catalog_id)');
        $this->addSql('ALTER TABLE storage.parent_catalog ADD CONSTRAINT FK_DA3DA2288B7FE2AC FOREIGN KEY (parent_catalog_id) REFERENCES storage.catalog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.parent_catalog ADD CONSTRAINT FK_DA3DA22828E39897 FOREIGN KEY (child_catalog_id) REFERENCES storage.catalog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
