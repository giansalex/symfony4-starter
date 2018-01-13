<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 13/01/2018
 * Time: 01:24 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MailController
 * @Route("/mail")
 * @package App\Controller
 */
class MailController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('giansalex@gmail.com')
            ->setTo('giansalex@gmail.com')
            ->setBody('<h1>Index 1223</h1>',
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $suc = $mailer->send($message);

        return new Response("Message sending, response: ". $suc);
    }
}