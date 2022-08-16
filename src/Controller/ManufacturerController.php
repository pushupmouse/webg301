<?php

namespace App\Controller;

use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Repository\ManufacturerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/manufacturer')]
class ManufacturerController extends AbstractController
{ 
    #[Route('/index', name: 'manufacturer_index')]
    public function manufacturerIndex () {
      $manufacturers = $this->getDoctrine()->getRepository(Manufacturer::class)->findAll();
      return $this->render('manufacturer/index.html.twig',
          [
              'manufacturers' => $manufacturers
          ]);
    }
  
    #[Route('/detail/{id}', name: 'manufacturer_detail')]
    public function manufacturerDetail ($id, ManufacturerRepository $manufacturerRepository) {
        $manufacturer = $this->getDoctrine()->getRepository(Manufacturer::class)->find($id);
        if ($manufacturer == null) {
            $this->addFlash('Warning', 'Invalid manufacturer id !');
            return $this->redirectToRoute('manufacturer_index');
        }
        return $this->render('manufacturer/detail.html.twig',
        [
            'manufacturer' => $manufacturer
        ]);
    }
  
    #[Route('/delete/{id}', name: 'manufacturer_delete')]
    public function manufacturerDelete ($id, ManagerRegistry $managerRegistry) {
    }
  
    #[Route('/add', name: 'manufacturer_add')]
    public function manufacturerAdd (Request $request) {
    }
  
    #[Route('/edit/{id}', name: 'manufacturer_edit')]
    public function manufacturerEdit ($id, Request $request) {
    }
}
