<?php

namespace App\Controller\Admin;

use App\Entity\Tournoi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Exception\ForbiddenActionException;


class TournoiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tournoi::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('nom'), 
            DateTimeField::new('dateTournoi'),
           
        ];
    }
}