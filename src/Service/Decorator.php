<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/12/2017
 * Time: 23:02
 */

namespace App\Service;

/**
 * Class Decorator
 * @package App\Service
 */
class Decorator
{
    /**
     * @param string $value
     * @return string
     */
    public function upper(string $value): string
    {
        return strtoupper($value);
    }
}