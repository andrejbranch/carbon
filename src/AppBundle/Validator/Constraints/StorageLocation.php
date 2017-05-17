<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class StorageLocation extends Constraint
{
    public $objectNotFoundMessage = 'No %objectName% was found with %property% "%string%".';

    public $propertyNotUniqueMessage = 'Multiple %objectName% objects were found with %property% "%string%". To convert from string to object, the %property% property must be unique.';

    public $objectName;

    public $entity;

    public $property;

    public function __construct()
    {
        // $this->entity = $options['entity'];
        // $this->property = $options['property'];
        // $this->objectName = $options['objectName'];
    }

    public function validatedBy()
    {
        return 'storage_location_validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
