<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180207171127 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.sample ADD catalog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE storage.sample ADD CONSTRAINT FK_8017595DCC3C66FC FOREIGN KEY (catalog_id) REFERENCES storage.catalog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8017595DCC3C66FC ON storage.sample (catalog_id)');
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        $sampleQuery = 'SELECT * FROM storage.sample';
        $sampleStmt = $this->connection->prepare($sampleQuery);
        $sampleStmt->execute();

        while ($sample = $sampleStmt->fetch()) {

            $catalogQuery = 'SELECT * FROM storage.catalog WHERE name = :name';
            $catalogStmt = $this->connection->prepare($catalogQuery);
            $catalogStmt->execute(array(
                'name' => $sample['name'],
            ));

            $catalog = $catalogStmt->fetch();

            $sampleUpdateQuery = 'UPDATE storage.sample SET catalog_id = :catalog_id WHERE id = :id';
            $sampleUpdateStmt = $this->connection->prepare($sampleUpdateQuery);
            $sampleUpdateStmt->execute(array(
                'catalog_id' => $catalog['id'],
                'id' => $sample['id'],
            ));
        }

        $this->connection
            ->prepare('DROP INDEX IF EXISTS storage.sample_name_idx')
            ->execute();
        ;
        $this->connection
            ->prepare('ALTER TABLE storage.sample DROP name')
            ->execute();
        ;
        $this->connection
            ->prepare('ALTER TABLE storage.sample ALTER COLUMN catalog_id DROP NOT NULL')
            ->execute();
        ;
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
