<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/12/2017
 * Time: 22:46
 */

namespace App\Controller;

use App\Entity\Task;
use App\Service\Decorator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{
    DateType,SubmitType,TextType
};
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/")
     * @param LoggerInterface $logger
     * @return Response
     */
    public function index(LoggerInterface $logger): Response
    {
        $logger->info('user logging ' );
        return $this->render('home/index.html.twig', ['name' => $this->decorator->upper('Symfony')]);
    }

    /**
     * @Route("/new-task")
     */
    public function newTask()
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('app_home_index');
        }

        return $this->render('home/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}