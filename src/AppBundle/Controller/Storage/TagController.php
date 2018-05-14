<?php

namespace AppBundle\Controller\Storage;

use Carbon\ApiBundle\Controller\Storage\BaseTagController;

class TagController extends BaseTagController
{
    /**
     * @var string The form type for this resource
     */
    const FORM_TYPE = "tag";

    /**
     * Security config
     */
    protected $security = array(
        'GET' => array(
            'roles' => array('ROLE_USER'),
        ),
        'POST' => array(
            'roles' => array('ROLE_INVENTORY_ADMIN'),
        ),
        'PUT' => array(
            'roles' => array('ROLE_INVENTORY_ADMIN'),
        ),
        'DELETE' => array(
            'roles' => array('ROLE_INVENTORY_ADMIN'),
        )
    );
}
