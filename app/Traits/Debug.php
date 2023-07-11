<?php

namespace App\Traits;

/**
 * trait Debug
 * @package App\Traits
 */
trait Debug
{
    /**
     * /?debug=1
     * @param $var
     * @return void
     */
    public function dd($var): void
    {
        if (request()->input('debug') && config('app.env') != 'production') {
            dd($var);
        }
    }
}
