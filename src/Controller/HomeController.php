<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/12/2017
 * Time: 22:46
 */

namespace App\Controller;

use App\Service\Decorator;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @var Decorator
     */
    private $decorator;


    /**
     * HomeController constructor.
     * @param Decorator $decorator
     */
    public function __construct(Decorator $decorator)
    {
        $this->decorator = $decorator;
    }

    /**
     * @Route("/{name}")
     * @param string $name
     * @param LoggerInterface $logger
     * @return Response
     */
    public function index(string $name = 'anonymus', LoggerInterface $logger): Response
    {
        $logger->info('user: ' . $name);
        return $this->render('home/index.html.twig', ['name' => $this->decorator->upper($name)]);
    }
}