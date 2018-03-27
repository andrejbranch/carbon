<?php

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class StorageLocationValidator extends ConstraintValidator
{
    const ERROR_INSUFFICIENT_SPACE = 'Insufficient storage space.';

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
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

        # Check if user has permission to add samples to this division
        if (isset($divisionId)) {
            $user = $this->tokenStorage->getToken()->getUser();
            $divisionRepo = $this->em->getRepository('AppBundle\\Entity\\Storage\\Division');
            $canEdit = $divisionRepo->canUserEdit($sample->getDivision(), $user);
            if (!$canEdit) {
                $this->addError($sample, 'You do not have permission to edit this division.');
            }
        }

        # Check if location is taken

        if (isset($divisionId) && isset($divisionColumn) && ($divisionRow)) {

            $exists = $this->em->getRepository('AppBundle\\Entity\\Storage\\Sample')->findOneBy(array(
                'status' => 'Available',
                'division' => $divisionId,
                'divisionRow' => $divisionRow,
                'divisionColumn' => $divisionColumn,
            ));

            if ($exists && $exists->getId() != $sample->getId()) {
                $this->addError($sample, sprintf('Division %s - Row %s - Column %s is filled.', $divisionId, $divisionRow, $divisionColumn));
            }
        }

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
