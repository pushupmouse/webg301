<?php

namespace App\Controller;

use App\Entity\Laptop;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'add_to_cart')]
    public function addToCart(Request $request)
    {

        $session = $request->getSession();
        $laptop_id = $request->get('laptop_id');
        $session->set('laptop_id', $laptop_id);
        $laptop = $this->getDoctrine()->getRepository(Laptop::class)->find($laptop_id);
        $session->set('laptop', $laptop);
        $quantity = $request->get('quantity');
        $session->set('quantity', $quantity);
        $datetime = date('Y/m/d H:i:s');
        $session->set('datetime', $datetime);
        $price = $laptop->getPrice();
        $order_price = $price * $quantity;
        $session->set('order_price', $order_price);
        // $user = $this->getUser();
        // $session->set('user', $user);
        return $this->render('cart/index.html.twig');
    }

    #[Route('/order', name: 'order_product')]
    public function orderProduct(Request $request, ManagerRegistry $managerRegistry)
    {
        $session = $request->getSession();
        $laptop = $this->getDoctrine()->getRepository(Laptop::class)->find($session->get('laptop_id'));
        $quantity = $laptop->getQuantity();
        $order_quantity = $session->get('quantity');
        $updated_quantity = $quantity - $order_quantity;
        $laptop->setQuantity($updated_quantity);
        $manager = $managerRegistry->getManager();
        $manager->persist($laptop);
        $manager->flush();
        $this->addFlash('Success', 'Order completed successfully!');
        return $this->redirectToRoute('laptop_shop');
    }
}
