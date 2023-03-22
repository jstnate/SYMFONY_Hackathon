<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiftController extends AbstractController
{
    #[Route('/lift', name: 'app_lift')]
    public function index(): Response
    {
        return $this->render('lift/index.html.twig', [
            'controller_name' => 'LiftController',
        ]);
    }
}
