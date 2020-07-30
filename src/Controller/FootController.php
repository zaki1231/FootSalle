<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Tournoi;
use App\Entity\Equipe;
use App\Entity\Joueur;

use App\Repository\EquipeRepository;
use App\Repository\TournoiRepository;

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
     * @Route("/", name="home")
     */
    public function home(EquipeRepository $repo): Response
    {
        $repo = $this->getDoctrine()->getRepository(Equipe::class);
        $equipes = $repo->findAll();
        return $this->render('foot/home.html.twig', [
            'equipes' => $equipes
        ]);
    }


    /**
     * @Route("/reservation", name="reservation", methods={"POST", "GET"})
     */
    public function creerReservation(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservation;
        $form = $this->createFormBuilder($reservation)
            ->add('nom', TextType::class, [
                'required' => true,
            ])

            ->add('prenom', TextType::class, [
                'required' => true,
            ])

            ->add('numeroTel', TextType::class, [
                'required' => true,
            ])

            ->add('dateReservation', DateType::class)
            ->add('timeReservation', TimeType::class)
            ->getForm();

        $form->handleRequest($request);
        $reservationPrise = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reservation);
            $em->flush();
            $reservationPrise = true;
            dump($reservation);
        }

        return $this->render('foot/reservation.html.twig', [
            'formReservation' => $form->createView(),
            'reservationPrise' => $reservationPrise,
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/equipe/{id}", name="equipe")
     */
    public function CreerEquipe(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $repo = $this->getDoctrine()->getRepository(Tournoi::class);
        $tournoi = $repo->find($id);
        $limitEquipe = $tournoi->getLimitEquipe();

        if ($limitEquipe < 10){

            $formBuilder = $this->createFormBuilder();
            $formBuilder->add('nomEquipe', TextType::class, [
                'attr' => [
                    'placeholder' => 'nom equipe'
                ]
            ]);
    
            for ($i = 1; $i <= 2; $i++) {
                $formBuilder->add('Nom'.'_'.'joueur'.'-' . $i , TextType::class, [])
                    ->add('Prenom'.'_'.'joueur' .'-'. $i, TextType::class, [])
                    ->add('dateNaissance'. '_'. 'joueur'.'-' . $i , DateType::class, []);
            }
    
            $form = $formBuilder->getForm();
            $form->handleRequest($request);
            $equipe = new Equipe;
            
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
    
                $equipe->setNom($data['nomEquipe']);
                $equipe->setMatchGagne(0);
                $equipe->setMatchNul(0);
                $equipe->setMatchPerdu(0);
    
               
                $dataa=$tournoi->getLimitEquipe() +1;
                $tournoi->setLimitEquipe($dataa);
                $equipe->addTournoi($tournoi);
    
                for ($i = 1; $i <= 2; $i++) {
                    $joueur = new Joueur();
                    $joueur->setIdEquipe($equipe);
                    $joueur->setNom($data['Nom'.'_'.'joueur'.'-' . $i]);
                    $joueur->setPrenom($data['Prenom'.'_'.'joueur' .'-'. $i]);
                    $joueur->setDateNaissance($data['dateNaissance'. '_'. 'joueur'.'-' . $i ]);
                    $em->persist($joueur);
                }
                
                $em->persist($equipe);
                $em->flush();
            }
    
            return $this->render('foot/equipe.html.twig', [
                'formEquipe' => $form->createView(),
                'equipe' => $equipe
            ]);
        }else{
           
           $this->addFlash('erreur', 'tournoi complet !');
       
           return $this->render('foot/tournoi.html.twig', [
               'tournois' =>$tournoi
           ]);
        }
    }

       
    
    

}
