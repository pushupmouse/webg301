<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted("ROLE_ADMIN")]
#[Route('/category')]
class CategoryController extends AbstractController
{ 
    #[Route('/index', name: 'category_index')]
    public function categoryIndex () {
      $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
      return $this->render('category/index.html.twig',
          [
              'categories' => $categories
          ]);
    }
  
    #[Route('/detail/{id}', name: 'category_detail')]
    public function categoryDetail ($id, CategoryRepository $categoryRepository) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if ($category == null) {
            $this->addFlash('Warning', 'Invalid category id !');
            return $this->redirectToRoute('category_index');
        }
        return $this->render('category/detail.html.twig',
        [
            'category' => $category
        ]);
    }
  
    #[Route('/delete/{id}', name: 'category_delete')]
    public function categoryDelete($id, ManagerRegistry $managerRegistry)
    {
        $category = $managerRegistry->getRepository(Category::class)->find($id);
        if ($category == null) {
            $this->addFlash('Warning', 'Delete denied! Category id not found!');
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($category);
            $manager->flush();
            $this->addFlash('Success', 'Category deleted successfully!');
        }
        return $this->redirectToRoute('category_index');
    }
  
    #[Route('/add', name: 'category_add')]
    public function categoryAdd (Request $request) {
        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();
            $this->addFlash('Success', 'Category added successfully!');
            return $this->redirectToRoute('category_index');
        }
        return $this->renderForm(
            'category/add.html.twig',
            [
                'categoryForm' => $form
            ]
        );
    }
  
    #[Route('/edit/{id}', name: 'category_edit')]
    public function categoryEdit ($id, Request $request) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if ($category == null) {
            $this->addFlash('Warning', 'Category id does not exist!');
            return $this->redirectToRoute('category_index');
        } else {
            $form = $this->createForm(CategoryType::class, $category);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($category);
                $manager->flush();
                $this->addFlash('Success', 'Category edited successfully!');
                return $this->redirectToRoute('category_index');
            }
            return $this->renderForm(
                'category/edit.html.twig',
                [
                    'categoryForm' => $form
                ]
            );
        }
    }
}
