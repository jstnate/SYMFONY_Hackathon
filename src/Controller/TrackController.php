<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/track', name: 'app_track')]
    public function index(): Response
    {
        return $this->render('track/index.html.twig', [
            'controller_name' => 'TrackController',
            'user' => $this->security->getUser()->get
        ]);
    }
}
