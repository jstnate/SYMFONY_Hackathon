<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Domain;
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
         return $this->redirect($adminUrlGenerator->setController(DomainCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SYMFONY Hackathon');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Domains', 'fas fa-list', Domain::class);
    }
}
