<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803184905 extends AbstractMigration implements ContainerAwareInterface
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
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $query = 'select s.name from storage.sample s group by s.name';

        $selectStmt = $this->connection->prepare($query);
        $selectStmt->execute();

        $uniqueSampleNames = $selectStmt->fetchAll();
        foreach ($uniqueSampleNames as $uniqueSampleName) {
            $insertQuery = 'insert into storage.catalog (name, created_at, updated_at, created_by_id, updated_by_id, status) values (:name, now(), now(), 1, 1, :status)';
            $insertStmt = $this->connection->prepare($insertQuery);
            $insertStmt->execute(array(
                'name' => $uniqueSampleName['name'],
                'status' => 'Available',
            ));
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
