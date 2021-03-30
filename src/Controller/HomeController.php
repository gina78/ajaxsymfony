<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param BasketService $basketService
     * @param ProductsRepository $productRepository
     * @return Response
     */
    public function index(BasketService $basketService, ProductsRepository $productRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'products'=>$productRepository->findAll(),
        ]);
    }


}
