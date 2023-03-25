<?php

namespace App\Controller;

use App\Repository\DomainRepository;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DomainController extends AbstractController
{
    #[Route('/domain/{id}', name: 'app_domain')]
    public function index($id, DomainRepository $domainRepository, StationRepository $stationRepository): Response
    {
        $domain = $domainRepository->find($id);
        $stations = $stationRepository
            ->createQueryBuilder('d')
            ->select('d')
            ->where('d.domain =' . $id)
            ->getQuery()
            ->getResult();
        $banner = "domaine-" . random_int(1, 5) . ".png";

        return $this->render('domain/index.html.twig', [
            "domain" => $domain,
            "stations" => $stations,
            "banner" => $banner
        ]);
    }
}
