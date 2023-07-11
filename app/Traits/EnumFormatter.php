<?php

namespace App\Traits;

/**
 * trait EnumFormatter
 * @package App\Traits
 */
trait EnumFormatter
{
    /**
     * @param array $options
     * @return array
     */
    public function getEnumData(array $options)
    {
        $newOptions = [];
        foreach ($options as $key => $val) {
            $newOptions[] = [
                'id' => $val,
                'display' => $val
            ];
        }

        return $newOptions;
    }
}
