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

    #[Route('/list', name: 'category_list')]
    public function categoryList () {
      $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
      return $this->render('category/list.html.twig',
          [
              'categories' => $categories
          ]);
    }
  
    #[Route('/detail/{id}', name: 'category_detail')]
    public function categoryDetail ($id, CategoryRepository $categoryRepository) {
    }
  
    #[Route('/delete/{id}', name: 'category_delete')]
    public function categoryDelete ($id, ManagerRegistry $managerRegistry) {
    }
  
    #[Route('/add', name: 'category_add')]
    public function categoryAdd (Request $request) {
    }
  
    #[Route('/edit/{id}', name: 'category_edit')]
    public function categoryEdit ($id, Request $request) {
    }
}
