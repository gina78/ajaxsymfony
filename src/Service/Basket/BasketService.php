<?php


namespace App\Service\Basket;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProductsRepository;

class BasketService
{
    private $session;
    private $productRepository;

    public function __construct(SessionInterface $session, ProductsRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;

        if ($this->session->get('totals') === null) {
            $this->session->set('totals', 0);
        }
    }

    public function add(int $id): Response
    {
        if ($this->productRepository->find($id) == null) {
            return new Response('Error product not found!');
        }
        $basket = $this->session->get('basket', []);
        if (!empty($basket[$id])) {
            $basket[$id]++;
        } else {
            $basket[$id] = 1;
        }
        $this->session->set('basket', $basket);
        $basketData = [];
        foreach ($basket as $id => $quantity) {
            $basketData [] =
                [
                    'product' => $this->productRepository->find($id),
                    'quantity' => $quantity
                ];
        }
        return new Response('Added successfully');
    }


    public function remove(int $id): Response
    {
        if ($this->productRepository->find(intval($id)) == null) {
            return new Response('Error product not found!');
        }
        $basket = $this->session->get('basket', []);
        if (!empty($basket[$id])) {
           unset($basket[$id]);
        }
        $this->session->set('basket', $basket);
        return new Response('Delete successfully');
    }
    public function getFullBasket():array
    {
        $basket = $this->session->get('basket', []);
        $basketData = [];
        foreach ($basket as $id => $quantity) {
            $basketData [] =
                [
                    'product' => $this->productRepository->find($id),
                    'quantity' => $quantity
                ];
        }
        return $basketData;
    }

    public function countProduct(): int
    {
        $count = 0;
        foreach ($this->getFullBasket() as $sum) {
            $count += $sum['quantity'];
        }
        return $count;
    }

    public function totalSum(): float
    {
        $total = 0;
        foreach ($this->getFullBasket() as $sum) {
            $total += $sum['product']->getPrice() * $sum['quantity'];;
        }
        return $total;
    }
}