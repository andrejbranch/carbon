<?php

namespace AppBundle\Service\Import;

use Ddeboer\DataImport\ItemConverter\MappingItemConverter;

class CryoblockMappingItemConverter extends MappingItemConverter
{
    /**
     * Applies a mapping to an item
     *
     * @param array  $item
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    protected function applyMapping(array $item, $from, $to)
    {
        // skip equal fields
        if ($from == $to) {
            return $item;
        }

        // standard renaming
        if (!is_array($to)) {
            $item[$to] = $item[$from];
            unset($item[$from]);

            return $item;
        }

        // recursive renaming of an array
        foreach ($to as $nestedFrom => $nestedTo) {
            $item[$from] = $this->applyMapping($item[$from], $nestedFrom, $nestedTo);
        }

        return $item;
    }
}
