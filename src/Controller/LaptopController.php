<?php

namespace App\Controller;

use App\Entity\Laptop;
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
    }

    #[Route('/edit/{id}', name: 'laptop_edit')]
    public function laptopEdit($id, Request $request)
    {
    }
}
