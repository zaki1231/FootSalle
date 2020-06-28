<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


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
     * @Route("/", name="home")
     */

     public function home(){
         return $this->render('foot/home.html.twig');
     }

     /**
     * @Route("/reservation", name="reservation")
     */

    public function reservation(Request $request, EntityManagerInterface $manager){
        $reservation = new Reservation();
        $form = $this->createFormBuilder($reservation)
        ->add('nom', TextType::class, [
            'attr' => [
                'placeholder' =>'votre nom'
            ]
        ])
        ->add('prenom', TextType::class, [
            'attr' => [
                'placeholder' =>'votre prenom'
            ]
        ])
        
        ->add('numeroTel', TextType::class, [
            'attr' => [
                'placeholder' =>'votre numerero de tel'
            ]
        ])
        ->add('dateReservation', DateType::class)
        ->add('timeReservation', TimeType::class)
        ->getForm();

        $form->handleRequest($request);
        dump($reservation);
        return $this->render('foot/reservation.html.twig', [
            'formReservation'=> $form->createView()    
         ]);
    
        
        }
        


     /**
     * @Route("/tournoi", name="tournoi")
     */

    public function tournoi(){
        return $this->render('foot/tournoi.html.twig');
    }
}
