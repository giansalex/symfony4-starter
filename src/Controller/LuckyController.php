<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/12/2017
 * Time: 22:36
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LuckyController
 * @package App\Controller
 */
class LuckyController
{
    /**
     * @Route("/lucky/number")
     * @return Response
     */
    public function number()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}