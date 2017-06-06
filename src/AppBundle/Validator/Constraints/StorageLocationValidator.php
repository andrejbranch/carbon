<?php

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StorageLocationValidator extends ConstraintValidator
{
    const ERROR_INSUFFICIENT_SPACE = 'Insufficient storage space.';

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
        $sample = $value;

        if ($sample->getDivision()) {
            $divisionId = $sample->getDivision()->getId();
        }

        if ($sample->getDivisionRow()) {
            $divisionRow = $sample->getDivisionRow();
        }

        if ($sample->getDivisionColumn()) {
            $divisionColumn = $sample->getDivisionColumn();
        }

        $errors = array();

        # Check if a division was found
        if (!isset($divisionId) ) {

            if (!isset($errors['division'])) {
                $this->addError($sample, self::ERROR_INSUFFICIENT_SPACE);
            }

        }

        // # Check if a division was found
        // if (!isset($divisionId) ) {

        //     $errors[] = self::ERROR_INSUFFICIENT_SPACE;

        // })

        # Check if location is taken

        if (isset($divisionId) && isset($divisionColumn) && ($divisionRow)) {

            $exists = $this->em->getRepository('AppBundle\\Entity\\Storage\\Sample')->findOneBy(array(
                'status' => 'Available',
                'division' => $divisionId,
                'divisionRow' => $divisionRow,
                'divisionColumn' => $divisionColumn,
            ));

            if ($exists) {
                $this->addError($sample, sprintf('Division %s - Row %s - Column %s is filled.', $divisionId, $divisionRow, $divisionColumn));
            }
        }


        // return $errors;
    }

    private function addError($sample, $error)
    {
        $errors = $sample->getErrors();

        if (!isset($errors['storageLocation'])) {
            $errors['storageLocation'] = array();
        }

        $errors['storageLocation'][] = $error;
        $sample->setErrors($errors);
    }
}
