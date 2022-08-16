<?php

namespace App\Controller;

use App\Entity\Origin;
use App\Form\OriginType;
use App\Repository\OriginRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/origin')]
class OriginController extends AbstractController
{ 
    #[Route('/index', name: 'origin_index')]
    public function originIndex () {
      $origins = $this->getDoctrine()->getRepository(Origin::class)->findAll();
      return $this->render('origin/index.html.twig',
          [
              'origins' => $origins
          ]);
    }
  
    #[Route('/detail/{id}', name: 'origin_detail')]
    public function originDetail ($id, OriginRepository $originRepository) {
        $origin = $this->getDoctrine()->getRepository(Origin::class)->find($id);
        if ($origin == null) {
            $this->addFlash('Warning', 'Invalid origin id !');
            return $this->redirectToRoute('origin_index');
        }
        return $this->render('origin/detail.html.twig',
        [
            'origin' => $origin
        ]);
    }
  
    #[Route('/delete/{id}', name: 'origin_delete')]
    public function originDelete($id, ManagerRegistry $managerRegistry)
    {
        $origin = $managerRegistry->getRepository(Origin::class)->find($id);
        if ($origin == null) {
            $this->addFlash('Warning', 'Delete denied! Origin id not found!');
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($origin);
            $manager->flush();
            $this->addFlash('Success', 'Origin deleted successfully!');
        }
        return $this->redirectToRoute('origin_index');
    }
  
    #[Route('/add', name: 'origin_add')]
    public function originAdd (Request $request) {
        $origin = new Origin;
        $form = $this->createForm(OriginType::class, $origin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($origin);
            $manager->flush();
            $this->addFlash('Success', 'Origin added successfully!');
            return $this->redirectToRoute('origin_index');
        }
        return $this->renderForm(
            'origin/add.html.twig',
            [
                'originForm' => $form
            ]
        );
    }
  
    #[Route('/edit/{id}', name: 'origin_edit')]
    public function originEdit ($id, Request $request) {
        $origin = $this->getDoctrine()->getRepository(Origin::class)->find($id);
        if ($origin == null) {
            $this->addFlash('Warning', 'Origin id does not exist!');
            return $this->redirectToRoute('origin_index');
        } else {
            $form = $this->createForm(OriginType::class, $origin);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($origin);
                $manager->flush();
                $this->addFlash('Success', 'Origin edited successfully!');
                return $this->redirectToRoute('origin_index');
            }
            return $this->renderForm(
                'origin/edit.html.twig',
                [
                    'originForm' => $form
                ]
            );
        }
    }
}
