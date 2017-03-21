<?php

namespace AppBundle\Migration;

use AppBundle\Entity\Storage\Division;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170320162946 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('TRUNCATE storage.division CASCADE');
        $this->addSql('ALTER TABLE storage.division ADD lft INT NOT NULL');
        $this->addSql('ALTER TABLE storage.division ADD rgt INT NOT NULL');
        $this->addSql('ALTER TABLE storage.division DROP sort');
        $this->addSql('ALTER TABLE storage.division ADD description VARCHAR(300) NOT NULL');
    }

    public function postUp(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $metadata = $em->getClassMetaData('AppBundle\Entity\Storage\Division');
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $rootDivision = new Division();
        $rootDivision->setId(1);
        $rootDivision->setHasDimension(false);
        $rootDivision->setTitle('Storage Root');
        $rootDivision->setDescription('Storage Root');
        $em->persist($rootDivision);
        $em->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE storage.division DROP lft');
        $this->addSql('ALTER TABLE storage.division DROP rgt');
    }
}
