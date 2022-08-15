<?php

namespace App\Controller;

use App\Entity\Laptop;
use App\Repository\LaptopRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/laptop')]
class LaptopController extends AbstractController
{
    #[Route('/index', name: 'laptop_index')]
    public function laptopIndex()
    {
        $laptops = $this->getDoctrine()->getRepository(Laptop::class)->findAll();
        return $this->render('laptop/index.html.twig',
        [
            'laptops' => $laptops
        ]);
    }
}
