<?php

namespace App\Controller\Admin;
use App\Entity\Tournoi;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class Dashboard2Controller extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $usersListUrl = $this->get(CrudUrlGenerator::class)->build()->setController(TournoiCrudController::class)->generateUrl();
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
            MenuItem::section('Tournoi'),
            MenuItem::linkToCrud('Tournoi', 'fa fa-tags', Tournoi::class),
        ];

    }
}
