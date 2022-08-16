<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/index', name: 'category_index')]
    public function categoryIndex()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig',
        [
            'categories' => $categories
        ]);
    }
}
