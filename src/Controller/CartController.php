<?php

namespace App\Controller;

use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{

    private $basketService;

    public function __construct(BasketService $basketService, SessionInterface $session )
    {
        $this->basketService = $basketService;
    }

    /**
     * @Route ("/add/{id}", name="add_to_basket", methods={"GET"})
     * @param Request $request
     * @param null $id
     * @return Response
     */
    public function addToBasket(Request $request, $id = null): Response
    {

        return $this->basketService->add($id);
    }

    /**
     * @Route ("/deleteBasket/{id}", name="delete_product_basket")
     * @param Request $request
     * @param null $id
     * @return Response
     */
    public function deleteProductBasket(Request $request, $id = null): Response
    {
        return $this->basketService->remove($id);
    }
}