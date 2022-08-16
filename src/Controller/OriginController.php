<?php

namespace App\Controller;

use App\Entity\Origin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/origin')]
class OriginController extends AbstractController
{
    #[Route('/index', name: 'origin_index')]
    public function originIndex()
    {
        $origins = $this->getDoctrine()->getRepository(Origin::class)->findAll();
        return $this->render('origin/index.html.twig',
        [
            'origins' => $origins
        ]);
    }
}
