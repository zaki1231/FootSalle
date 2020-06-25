<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FootController extends AbstractController
{
    /**
     * @Route("/foot", name="foot")
     */
    public function index()
    {
        return $this->render('foot/index.html.twig', [
            'controller_name' => 'FootController',
        ]);
    }

    /**
     * @Route("/home", name="home")
     */

     public function home(){
         return $this->render('foot/home.html.twig');
     }

     /**
     * @Route("/reservation", name="reservation")
     */

    public function reservation(){
        return $this->render('foot/reservation.html.twig');
    }

     /**
     * @Route("/tournoi", name="tournoi")
     */

    public function tournoi(){
        return $this->render('foot/tournoi.html.twig');
    }
}
