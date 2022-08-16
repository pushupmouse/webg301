<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/brand')]
class BrandController extends AbstractController
{ 
    #[Route('/index', name: 'brand_index')]
    public function brandIndex () {
      $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll();
      return $this->render('brand/index.html.twig',
          [
              'brands' => $brands
          ]);
    }
  
    #[Route('/detail/{id}', name: 'brand_detail')]
    public function brandDetail ($id, BrandRepository $brandRepository) {
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        if ($brand == null) {
            $this->addFlash('Warning', 'Invalid brand id !');
            return $this->redirectToRoute('brand_index');
        }
        return $this->render('brand/detail.html.twig',
        [
            'brand' => $brand
        ]);
    }
  
    #[Route('/delete/{id}', name: 'brand_delete')]
    public function brandDelete ($id, ManagerRegistry $managerRegistry) {
    }
  
    #[Route('/add', name: 'brand_add')]
    public function brandAdd (Request $request) {
    }
  
    #[Route('/edit/{id}', name: 'brand_edit')]
    public function brandEdit ($id, Request $request) {
    }
}
