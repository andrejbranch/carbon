<?php

namespace AppBundle\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170501155533 extends AbstractMigration implements ContainerAwareInterface
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

        $repo = $em->getRepository('AppBundle\Entity\Storage\Division');
        $divisions = $repo->findAll();

        foreach ($divisions as $division) {

            $tree = array();
            $tree[] = $currentDivision = $division;

            while ($currentDivision) {

                $currentDivision = $currentDivision->getParent();

                if ($currentDivision) {
                    $tree[] = $currentDivision;
                }

            }

            $path = array();
            $idPath = array();
            $tree = array_reverse($tree);

            unset($tree[0]);

            foreach ($tree as $node) {
                $path[] = $node->getTitle();
                $idPath[] = $node->getId();
            }

            $path = implode(' / ', $path);
            $idPath = ' ' . implode(' ', $idPath) . ' ';

            $division->setPath($path);
            $division->setIdPath($idPath);

        }

        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
