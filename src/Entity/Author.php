<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 26/12/2017
 * Time: 05:34 PM
 */

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Author
 */
class Author
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;
}