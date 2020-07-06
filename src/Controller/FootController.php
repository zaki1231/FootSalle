<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Users;
use App\Entity\Tournoi;
use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Repository\ReservationRepository;
use App\Repository\TournoiRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Response;

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

    public function home()
    {
        return $this->render('foot/home.html.twig');
    }

    /**
     * @Route("/reservation", name="reservation", methods={"POST", "GET"})
     */

    public function creerReservation(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createFormBuilder() 
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'votre prenom'
                ]
            ])

            ->add('numeroTel', TextType::class, [
                'attr' => [
                    'placeholder' => 'votre numerero de tel'
                ]
            ])
            ->add('dateReservation', DateType::class)
            ->add('timeReservation', TimeType::class)
            ->getForm();

       $reservation = new Reservation;
        $form->handleRequest($request);
       $reservationPrise = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

           $reservation->setNom($data['nom']);
           $reservation->setPrenom($data['prenom']);
           $reservation->setNumeroTel($data['numeroTel']);
           $reservation->setDateReservation($data['dateReservation']);
           $reservation->setTimeReservation($data['timeReservation']);
            $em->persist($reservation);
            $em->flush();
           $reservationPrise = true;
            dump($reservation);
        }


        return $this->render('foot/reservation.html.twig', [
            'formReservation' => $form->createView(),
            'reservationPrise' =>$reservationPrise,
            'reservation' =>$reservation
        ]);
    }



    /**
     * @Route("/tournoi", name="tournoi")
     */

    public function tournoi(TournoiRepository $repo): Response
    {
        $repo = $this->getDoctrine()->getRepository(Tournoi::class);
        $tournois = $repo->findAll();
        return $this->render('foot/tournoi.html.twig', [
            'tournois' => $tournois

        ]);
    }
    /**
     * @Route("/equipe", name="equipe")
     */

    public function CreerEquipe(Request $request, EntityManagerInterface $em): Response
    {

        $formBuilder = $this->createFormBuilder();

        $formBuilder -> add('nomEquipe', TextType::class, [
                'attr' => [
                    'placeholder' => 'nom equipe'
                ]
            ]);

        for ($i = 1; $i <= 3; $i++) {
            $formBuilder->add('joueur'.$i.'nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'nom'
                ]
            ])
            ->add('joueur'.$i.'prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'nom'
                ]
            ])
            ->add('joueur'.$i.'dateNaissance', DateType::class, [
                'attr' => [
                    'placeholder' => 'date de naissance'
                ]
            ]);
        }
                  
        $form = $formBuilder -> getForm();

        $form->handleRequest($request);
        $equipe = new Equipe;
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

           $equipe->setNom($data['nomEquipe']);
           $equipe->setMatchGagne(0);
           $equipe->setMatchNul(0);
           $equipe->setMatchPerdu(0);

           for($i = 1; $i <= 3; $i++) {
            $joueur = new Joueur();
            $joueur->setIdEquipe($equipe);
            $joueur->setNom($data['joueur'.$i.'nom']);
            $joueur->setPrenom($data['joueur'.$i.'prenom']);
            $joueur->setDateNaissance($data['joueur'.$i.'dateNaissance']);
            $em->persist($joueur);
           }
            $em->persist($equipe);
           
            $em->flush();
            
            dump($equipe);
        }


        return $this->render('foot/equipe.html.twig', [
            'formEquipe' => $form->createView(),

            'equipe' => $equipe
        ]);
    }


    /**
     * @Route("/joueur", name="joueur")
     */

    public function joueur(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createFormBuilder()
        
        ->add('nomEquipe', TextType::class, [
            'attr' => [
                'placeholder' => 'nom equipe'
            ]
        ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'prenom'
                ]
            ])
            ->add('dateNaissance', TextType::class, [
                'attr' => [
                    'placeholder' => 'date de naissance'
                ]
            ])
            
            ->getForm();

        $joueur = new Joueur;
        $form->handleRequest($request);
        $joueurExist= false;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

           $joueur->setNom($data['nom']);
           $joueur->setPrenom($data['prenom']);
           $joueur->setDateNaissance($data['dateNaissance']);
           
         
            $em->persist($joueur);
            $em->flush();
            $joueurExist= true;
            dump($joueur);
        }


        return $this->render('foot/joueur.html.twig', [
            'formJoueur' => $form->createView(),
            'joueurExist' => $joueurExist,
            'joueur' => $joueur
        ]);
    }

    
}
