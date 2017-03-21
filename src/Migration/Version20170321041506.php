<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170321041506 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE storage.division_editor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE storage.division_editor (id INT NOT NULL, user_id INT NOT NULL, division_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_74D649B5A76ED395 ON storage.division_editor (user_id)');
        $this->addSql('CREATE INDEX IDX_74D649B541859289 ON storage.division_editor (division_id)');
        $this->addSql('ALTER TABLE storage.division_editor ADD CONSTRAINT FK_74D649B5A76ED395 FOREIGN KEY (user_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.division_editor ADD CONSTRAINT FK_74D649B541859289 FOREIGN KEY (division_id) REFERENCES storage.division (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE storage.division_editor_id_seq CASCADE');
        $this->addSql('DROP TABLE storage.division_editor');
    }
}
