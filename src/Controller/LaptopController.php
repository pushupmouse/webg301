<?php

namespace App\Controller;

use App\Entity\Laptop;
use App\Form\LaptopType;
use App\Repository\LaptopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/laptop')]
class LaptopController extends AbstractController
{
    #[Route('/shop', name: 'laptop_shop')]
    public function laptopShop()
    {
        $laptops = $this->getDoctrine()->getRepository(Laptop::class)->findAll();
        return $this->render(
            'laptop/shop.html.twig',
            [
                'laptops' => $laptops
            ]
        );
    }

    #[Route('/index', name: 'laptop_index')]
    public function laptopIndex()
    {
        $laptops = $this->getDoctrine()->getRepository(Laptop::class)->findAll();
        return $this->render(
            'laptop/index.html.twig',
            [
                'laptops' => $laptops
            ]
        );
    }

    #[Route('/detail/{id}', name: 'laptop_detail')]
    public function laptopDetail($id)
    {
        $laptop = $this->getDoctrine()->getRepository(Laptop::class)->find($id);
        if ($laptop == null) {
            $this->addFlash('Warning', 'Invalid laptop id !');
            return $this->redirectToRoute('laptop_index');
        }
        return $this->render(
            'laptop/detail.html.twig',
            [
                'laptop' => $laptop
            ]
        );
    }

    #[Route('/delete/{id}', name: 'laptop_delete')]
    public function laptopDelete($id, ManagerRegistry $managerRegistry)
    {
        $laptop = $managerRegistry->getRepository(Laptop::class)->find($id);
        if ($laptop == null) {
            $this->addFlash('Warning', 'Delete denied! Laptop id not found!');
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($laptop);
            $manager->flush();
            $this->addFlash('Success', 'Laptop deleted successfully!');
        }
        return $this->redirectToRoute('laptop_index');
    }

    #[Route('/add', name: 'laptop_add')]
    public function laptopAdd(Request $request)
    {
        $laptop = new Laptop;
        $form = $this->createForm(LaptopType::class, $laptop);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($laptop);
            $manager->flush();
            $this->addFlash('Success', 'Laptop added successfully!');
            return $this->redirectToRoute('laptop_index');
        }
        return $this->renderForm(
            'laptop/add.html.twig',
            [
                'laptopForm' => $form
            ]
        );
    }

    #[Route('/edit/{id}', name: 'laptop_edit')]
    public function laptopEdit($id, Request $request)
    {
        $laptop = $this->getDoctrine()->getRepository(Laptop::class)->find($id);
        if ($laptop == null) {
            $this->addFlash('Warning', 'Laptop id does not exist!');
            return $this->redirectToRoute('laptop_index');
        } else {
            $form = $this->createForm(LaptopType::class, $laptop);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($laptop);
                $manager->flush();
                $this->addFlash('Success', 'Laptop edited successfully!');
                return $this->redirectToRoute('laptop_index');
            }
            return $this->renderForm(
                'laptop/edit.html.twig',
                [
                    'laptopForm' => $form
                ]
            );
        }
    }

    #[Route('/price/asc', name: 'sort_asc_price')]
    public function sortLaptopPriceAsc(LaptopRepository $laptopRepository){
        $laptops = $laptopRepository->sortLaptopByPriceAsc();
        return $this->render('laptop/shop.html.twig',
        [
            'laptops'=>$laptops
        ]);
    }
    
    #[Route('/price/desc', name: 'sort_desc_price')]
    public function sortLaptopPriceDesc(LaptopRepository $laptopRepository){
        $laptops = $laptopRepository->sortLaptopByPriceDesc();
        return $this->render('laptop/shop.html.twig',
        [
            'laptops'=>$laptops
        ]);
    }

    #[Route('/search', name: 'search_laptop')]
    public function searchLaptop(LaptopRepository $laptopRepository, Request $request)
    {
        $laptops = $laptopRepository->searchLaptop($request->get('keyword'));
        $session = $request->getSession();
        $session->set('search', true);
        return $this->render(
            'laptop/shop.html.twig',
            [
                'laptops' => $laptops,
            ]
        );
    }
}
