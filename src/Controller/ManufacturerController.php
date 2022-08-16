<?php

namespace App\Controller;

use App\Entity\Manufacturer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManufacturerController extends AbstractController
{
    #[Route('/index', name: 'manufacturer_index')]
    public function manufacturerIndex()
    {
        $manufacturers = $this->getDoctrine()->getRepository(Manufacturer::class)->findAll();
        return $this->render('manufacturer/index.html.twig',
        [
            'manufacturers' => $manufacturers
        ]);
    }
}
