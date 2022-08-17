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

#[IsGranted("ROLE_ADMIN")]
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
    public function manufacturerDelete($id, ManagerRegistry $managerRegistry)
    {
        $manufacturer = $managerRegistry->getRepository(Manufacturer::class)->find($id);
        if ($manufacturer == null) {
            $this->addFlash('Warning', 'Delete denied! Manufacturer id not found!');
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($manufacturer);
            $manager->flush();
            $this->addFlash('Success', 'Manufacturer deleted successfully!');
        }
        return $this->redirectToRoute('manufacturer_index');
    }
  
    #[Route('/add', name: 'manufacturer_add')]
    public function manufacturerAdd (Request $request) {
        $manufacturer = new Manufacturer;
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($manufacturer);
            $manager->flush();
            $this->addFlash('Success', 'Manufacturer added successfully!');
            return $this->redirectToRoute('manufacturer_index');
        }
        return $this->renderForm(
            'manufacturer/add.html.twig',
            [
                'manufacturerForm' => $form
            ]
        );
    }
  
    #[Route('/edit/{id}', name: 'manufacturer_edit')]
    public function manufacturerEdit ($id, Request $request) {
        $manufacturer = $this->getDoctrine()->getRepository(Manufacturer::class)->find($id);
        if ($manufacturer == null) {
            $this->addFlash('Warning', 'Manufacturer id does not exist!');
            return $this->redirectToRoute('manufacturer_index');
        } else {
            $form = $this->createForm(ManufacturerType::class, $manufacturer);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($manufacturer);
                $manager->flush();
                $this->addFlash('Success', 'Manufacturer edited successfully!');
                return $this->redirectToRoute('manufacturer_index');
            }
            return $this->renderForm(
                'manufacturer/edit.html.twig',
                [
                    'manufacturerForm' => $form
                ]
            );
        }
    }
}
