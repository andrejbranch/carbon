<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170313164601 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.division ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT FK_8017595D896DBBDE');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT FK_8017595DB03A8386');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DB03A8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.division DROP sort');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT fk_8017595db03a8386');
        $this->addSql('ALTER TABLE storage.sample DROP CONSTRAINT fk_8017595d896dbbde');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT fk_8017595db03a8386 FOREIGN KEY (created_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT fk_8017595d896dbbde FOREIGN KEY (updated_by_id) REFERENCES cryoblock."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
