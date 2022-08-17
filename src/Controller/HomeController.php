<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_CUSTOMER")]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index()
    {
        return $this->render('home/homepage.html.twig');
    }
}
