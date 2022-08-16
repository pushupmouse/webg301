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

    #[Route('/list', name: 'brand_list')]
    public function brandList () {
      $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll();
      return $this->render('brand/list.html.twig',
          [
              'brands' => $brands
          ]);
    }
  
    #[Route('/detail/{id}', name: 'brand_detail')]
    public function brandDetail ($id, BrandRepository $brandRepository) {
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
