<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 26/12/2017
 * Time: 06:09 PM
 */

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Exception\LogicException;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog-edit")
     * @param Registry $workflows
     * @return Response
     */
    public function edit(Registry $workflows)
    {
        $post = new BlogPost();
        $workflow = $workflows->get($post);

        // if there are multiple workflows for the same class,
        // pass the workflow name as the second argument
        // $workflow = $workflows->get($post, 'blog_publishing');

        $workflow->can($post, 'publish'); // False
        $workflow->can($post, 'to_review'); // True

        // Update the currentState on the post
        try {
            $workflow->apply($post, 'to_review');
        } catch (LogicException $e) {
            // ... if the transition is not allowed
            var_dump($e);
        }

        // See all the available transitions for the post in the current state
        $transitions = $workflow->getEnabledTransitions($post);

        return new Response('Workflow');
    }
}