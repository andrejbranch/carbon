<?php

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StorageLocationValidator extends ConstraintValidator
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if (isset($value['division'])) {
            $divisionId = $value['division']->getId();
        }

        if (isset($value['divisionRow'])) {
            $divisionRow = $value['divisionRow'];
        }

        if (isset($value['divisionColumn'])) {
            $divisionColumn = $value['divisionColumn'];
        }

        $errors = array();

        if (isset($divisionId) && isset($divisionColumn) && ($divisionRow)) {

            $exists = $this->em->getRepository('AppBundle\\Entity\\Storage\\Sample')->findOneBy(array(
                'status' => 'Available',
                'division' => $divisionId,
                'divisionRow' => $divisionRow,
                'divisionColumn' => $divisionColumn,
            ));

            if ($exists) {
                $errors[] = sprintf('Division %s - Row %s - Column %s is filled.', $divisionId, $divisionRow, $divisionColumn);
            }
        }

        return $errors;
    }
}
