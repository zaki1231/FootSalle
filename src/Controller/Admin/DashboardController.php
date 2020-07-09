<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/Users")
     */
    public function index(): Response
    {
        $usersListUrl = $this->get(CrudUrlGenerator::class)->build()->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($usersListUrl);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FootSalle');
    }

    public function configureMenuItems(): iterable
    {

        return [
            MenuItem::linkToDashboard('Dashboard', 'fa-home'),

            MenuItem::section('User'),
            MenuItem::linkToCrud('User', 'fa fa-tags', User::class),
        ];

    }
}
