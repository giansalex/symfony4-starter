<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/12/2017
 * Time: 22:46
 */

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Task;
use App\Service\Decorator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{
    DateType,SubmitType,TextType
};
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /**
     * @Route("/hello/{name}")
     * @param TranslatorInterface $translator
     * @param string $name
     * @return Response
     */
    public function hello(TranslatorInterface $translator, string $name): Response
    {
        $translator->setLocale('fr_FR');
        $text = $translator->trans('Hola %name%', ['%name%' => $name]);

        return $this->render('home/hello.html.twig', ['saludo' => $text]);
    }

    /**
     * @Route("/validate")
     * @return Response
     */
    public function author(ValidatorInterface $validator): Response
    {
        $author = new Author();
        $author->name = 'Giancarlos';
        // ... do something to the $author object

//        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('The author is valid! Yes!');
    }
}