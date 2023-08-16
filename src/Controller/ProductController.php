<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ProductRepository;


class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager,ValidatorInterface $validator): Response
    {



        $product = new Product();
        // This will trigger an error: the column isn't nullable in the database
        $product->setName("anouar");
        // This will trigger a type mismatch error: an integer is expected
        $product->setPrice('1999');
        // ...

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $product = new Product();
        $product->setName('anooouar');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }


//    #[Route('/product/{id}', name: 'product_show')]
//    public function show(EntityManagerInterface $entityManager, int $id): Response
//    {
//        $product = $entityManager->getRepository(Product::class)->find($id);
//
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$id
//            );
//        }
//
//        return new Response('Check out this great product: '.$product->getName());
//
//        // or render a template
//        // in the template, print things with {{ product.name }}
//        // return $this->render('product/show.html.twig', ['product' => $product]);
//    }

    #[Route('/product/{id}')]
    public function show(Product $product): Response
    {
        dd('kk');
        // use the Product!
        return new Response('Check out this great product: '.$product->getName());
        // ...
    }
}
