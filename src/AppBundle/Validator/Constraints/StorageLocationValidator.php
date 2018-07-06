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

    protected $takenLocations = array();

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function validate($value, Constraint $constraint)
    {
        $sample = $value;

        if (!$sample->getSampleType() || !$sample->getStorageContainer()) {
            return;
        }

        if ($sample->getDivision()) {
            $divisionId = $sample->getDivision()->getId();
        }

        if ($sample->getDivisionRow()) {
            $divisionRow = $sample->getDivisionRow();
        }

        if ($sample->getDivisionColumn()) {
            $divisionColumn = $sample->getDivisionColumn();
        }

        // make sure if sample status is not available that division is not specified
        if ($sample->getStatus() != 'Available' && $sample->getDivision()) {
            $this->addError($sample, 'Samples that are not available can not be stored in a division.');
        }

        // make sure 2 locations dont conflict
        if (isset($divisionId) && isset($divisionRow) && isset($divisionColumn)) {

            if (!array_key_exists($divisionId, $this->takenLocations)) {
                $this->takenLocations[$divisionId][$divisionRow] = array($divisionColumn => true);
            } elseif (
                array_key_exists($divisionRow, $this->takenLocations[$divisionId]) &&
                !array_key_exists(intval($divisionColumn), $this->takenLocations[$divisionId][$divisionRow])
            ) {
                $this->takenLocations[$divisionId][$divisionRow][$divisionColumn] = true;
            } elseif (
                array_key_exists($divisionRow, $this->takenLocations[$divisionId]) &&
                array_key_exists(intval($divisionColumn), $this->takenLocations[$divisionId][$divisionRow])
            ) {
                $this->addError($sample, 'Two samples can not occupy the same row and column.');
            }
        }

        $errors = array();

        # Check if a division was found
        if ($sample->getStatus() == 'Available' && !isset($divisionId) ) {

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
                $this->addError($sample, 'Sorry, you do not have permission to edit this division.');
            }
        }

        # Check if division allows for samples type
        if (isset($divisionId)) {

            if (!$sample->getDivision()->getAllowAllSampleTypes()) {

                $allowsSampleType = false;
                $divisionSampleTypes = $sample->getDivision()->getDivisionSampleTypes();
                foreach ($divisionSampleTypes as $divisionSampleType) {
                    if ($divisionSampleType->getSampleType()->getId() == $sample->getSampleType()->getId()) {
                        $allowsSampleType = true;
                    }
                }

                if (!$allowsSampleType) {

                    $this->addError($sample, sprintf('Sorry, Division %s does not allow sample type %s.', $sample->getDivision()->getId(), $sample->getSampleType()->getName()));

                }

            }
        }

        # Check if division allows for samples storage container type
        if (isset($divisionId)) {

            if (!$sample->getDivision()->getAllowAllStorageContainers()) {

                $allowsStorageContainer = false;
                $divisionStorageContainers = $sample->getDivision()->getDivisionStorageContainers();
                foreach ($divisionStorageContainers as $divisionStorageContainer) {
                    if ($divisionStorageContainer->getStorageContainer()->getId() == $sample->getStorageContainer()->getId()) {
                        $allowsStorageContainer = true;
                    }
                }

                if (!$allowsStorageContainer) {

                    $this->addError($sample, sprintf('Sorry, Division %s does not allow storage container type %s.', $sample->getDivision()->getId(), $sample->getStorageContainer()->getName()));

                }

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
                $this->addError($sample, sprintf('Sorry, division %s - Row %s - Column %s is filled.', $divisionId, $divisionRow, $divisionColumn));
            }
        }

    }

    private function addError($sample, $error)
    {
        if ($this->context) {
            $this->context->buildViolation($error)
                ->addViolation()
            ;
        }

        $errors = $sample->getErrors();

        if (!isset($errors['storageLocation'])) {
            $errors['storageLocation'] = array();
        }

        $errors['storageLocation'][] = $error;
        $sample->setErrors($errors);
    }
}
