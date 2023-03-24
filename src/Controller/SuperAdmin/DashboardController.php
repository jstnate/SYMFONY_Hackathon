<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Clutter;
use App\Entity\Difficulty;
use App\Entity\Domain;
use App\Entity\Level;
use App\Entity\Material;
use App\Entity\Type;
use App\Entity\Review;
use App\Repository\ReviewRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/super-admin', name: 'super-admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         $authorizationChecker = $this->container->get('security.authorization_checker');

         if (!$authorizationChecker->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('app_login');
         }
         return $this->redirect($adminUrlGenerator->setController(ReviewCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SYMFONY Hackathon');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Reviews', 'fa-regular fa-star', Review::class);
        yield MenuItem::linkToCrud('Domains', 'fas fa-list', Domain::class);
        yield MenuItem::linkToCrud('Lifts Type', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Tracks Difficulties', 'fas fa-list', Difficulty::class);
        yield MenuItem::linkToCrud('Level Requirements', 'fas fa-list', Level::class);
        yield MenuItem::linkToCrud('Clutters', 'fas fa-list', Clutter::class);
        yield MenuItem::linkToCrud('Material', 'fas fa-list', Material::class);
    }
}
