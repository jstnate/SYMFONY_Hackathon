<?php

namespace App\Controller;

use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    #[Route('/station', name: 'app_station')]
    public function index(StationRepository $stationRepository): Response
    {
        return $this->render('station/index.html.twig', [
            'stations' => $stationRepository->findAll(),
        ]);
    }

    #[Route('/station/{id}', name: 'app_station_show')]
    public function show($id, StationRepository $stationRepository): Response
    {
        return $this->render('station/show.html.twig', [
            'station' => $stationRepository->find($id),
        ]);
    }
}
