<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @Route("/product")
 * @package App\Controller
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);

        $em->persist($product);

        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/{id}", name="product_show")
     */
    public function show(Product $product)
    {
//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }

        return new Response('Check out this great product: '.$product->getName());
    }

    /**
     * @Route("/edit/{id}", methods={"POST"})
     */
    public function update($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }

    /**
     * @Route("/delete/{id}")
     */
    public function delete(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($product);
        $em->flush();

        return new Response('Product Removed');
    }
}
