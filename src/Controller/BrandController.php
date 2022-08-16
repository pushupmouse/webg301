<?php

namespace App\Controller;

use App\Entity\Brand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BrandController extends AbstractController
{
    #[Route('/index', name: 'brand_index')]
    public function brandIndex()
    {
        $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll();
        return $this->render('brand/index.html.twig',
        [
            'brands' => $brands
        ]);
    }
}
