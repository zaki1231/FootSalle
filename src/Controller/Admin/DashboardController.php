<?php

namespace App\Controller\Admin;
use App\Entity\Equipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
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
        yield MenuItem::linktoDashboard('Tournoi', 'fa fa-home');
       
        yield MenuItem::linkToCrud('Equipe', 'fa fa-home', Equipe::class);
    }
}
