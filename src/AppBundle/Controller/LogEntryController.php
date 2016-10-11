<?php

namespace AppBundle\Controller;

use Carbon\ApiBundle\Controller\CarbonApiController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LogEntryController extends CarbonApiController
{
    /**
     * @var string The namespace of the resource entity
     */
    const RESOURCE_ENTITY = "Gedmo\Loggable\Entity\LogEntry";

    /**
     * Handles the HTTP get request for the card entity
     *
     * @Route("/log-entry", name="log_entry_get")
     * @Method("GET")
     * @return [type] [description]
     */
    public function handleGet()
    {

        $sample = $this->getEntityManager()->getRepository('AppBundle:Sample')->find(20);

        $logs = $this->getEntityRepository()->getLogEntries($sample);

        var_dump($logs);
        die;

        return $this->getJsonResponse($data);

    }
}
