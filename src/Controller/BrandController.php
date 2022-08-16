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
    public function brandIndex()
    {
        $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll();
        return $this->render(
            'brand/index.html.twig',
            [
                'brands' => $brands
            ]
        );
    }

    #[Route('/detail/{id}', name: 'brand_detail')]
    public function brandDetail($id, BrandRepository $brandRepository)
    {
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        if ($brand == null) {
            $this->addFlash('Warning', 'Invalid brand id !');
            return $this->redirectToRoute('brand_index');
        }
        return $this->render(
            'brand/detail.html.twig',
            [
                'brand' => $brand
            ]
        );
    }

    #[Route('/delete/{id}', name: 'brand_delete')]
    public function brandDelete($id, ManagerRegistry $managerRegistry)
    {
        $brand = $managerRegistry->getRepository(Brand::class)->find($id);
        if ($brand == null) {
            $this->addFlash('Warning', 'Delete denied! Brand id not found!');
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($brand);
            $manager->flush();
            $this->addFlash('Success', 'Brand deleted successfully!');
        }
        return $this->redirectToRoute('brand_index');
    }

    #[Route('/add', name: 'brand_add')]
    public function brandAdd(Request $request)
    {
        $brand = new Brand;
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($brand);
            $manager->flush();
            $this->addFlash('Success', 'Brand added successfully!');
            return $this->redirectToRoute('brand_index');
        }
        return $this->renderForm(
            'brand/add.html.twig',
            [
                'brandForm' => $form
            ]
        );
    }

    #[Route('/edit/{id}', name: 'brand_edit')]
    public function brandEdit($id, Request $request)
    {
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        if ($brand == null) {
            $this->addFlash('Warning', 'Brand id does not exist!');
            return $this->redirectToRoute('brand_index');
        } else {
            $form = $this->createForm(BrandType::class, $brand);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($brand);
                $manager->flush();
                $this->addFlash('Success', 'Brand edited successfully!');
                return $this->redirectToRoute('brand_index');
            }
            return $this->renderForm(
                'brand/edit.html.twig',
                [
                    'brandForm' => $form
                ]
            );
        }
    }
}
