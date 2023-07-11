<?php

namespace App\Renderer;

/**
 * class Renderer
 * @package App\Renderer
 */
abstract class Renderer
{
    /**
     * @param $classes
     * @return array
     */
    public function renderList($classes): array
    {
        $buffer = [];
        /** @var Class $aClass */
        foreach ($classes as $aClass) {
            $buffer[] = $this->render($aClass);
        }

        return $buffer;
    }
}
