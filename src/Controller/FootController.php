<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Tournoi;
use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Form\EquipeType;
use App\Form\JoueurType;

use App\Repository\EquipeRepository;
use App\Repository\ReservationRepository;
use App\Repository\TournoiRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Length;

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
        $equipesAffichees = [];
        for($i=0; $i < 3; $i++) {
            array_push($equipesAffichees, $equipes[$i]);
        }
        return $this->render('foot/home.html.twig', [
            'equipes' => $equipesAffichees,
            'nbEquipes' => count($equipes)
        ]);
    }

    
    /**
     * @Route("/charger_equipes/{rowId}",options={"expose"=true}, name="charger_equipes")
     */
    public function chargerEquipes($rowId, EquipeRepository $repo, SerializerInterface $serializer): Response
    { 
        $repo = $this->getDoctrine()->getRepository(Equipe::class);
        $equipes = $repo->findAll();
        
        $equipesAffichees = [];
        $limite = count($equipes); 
        if($rowId + 3 > count($equipes)) {
            $limite = count($equipes);            
        } else {
            $limite = $rowId + 3;
        }

        // i = 3; i < 6; i = i + 1
        for($i=$rowId; $i < $limite; $i++) {
            array_push($equipesAffichees, $equipes[$i]);
        }
                
        $data = $serializer->serialize($equipesAffichees, 'json', [AbstractNormalizer::ATTRIBUTES => ['nom', 'matchGagne', 'matchPerdu', 'matchNul']]);
        return new JsonResponse($data, 200, array(), true);
    }


    /**
     * @Route("/reservation", name="reservation", methods={"POST", "GET"})
     */
    public function creerReservation(Request $request, EntityManagerInterface $em, ReservationRepository $repo ): Response
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

            ->add('dateReservation', DateType::class, ['label' => 'Date de réservation'])
            ->add('timeReservation', TimeType::class, ['label' => 'Heure de réservation'])
            ->getForm();

        $form->handleRequest($request);
        $reservationPrise = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reservation);
            $em->flush();
            $reservationPrise = true;
            $this->redirectToRoute('reservation', ['_fragment' => 'reservation']);
        }

        return $this->render('foot/reservation.html.twig',[
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
        
            $equipe = new Equipe();
            $joueur = new Joueur();
            $equipe->getJoueurs()->add($joueur);
    
            $form = $this->createForm(EquipeType::class, $equipe);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $equipeData = $form->getData();
                
                $equipe->setNom($equipeData->getNom());
                $equipe->setMatchGagne(0);
                $equipe->setMatchNul(0);
                $equipe->setMatchPerdu(0);
    
                $dataTournoi=$tournoi->getLimitEquipe() +1;
                $tournoi->setLimitEquipe($dataTournoi);
                $equipe->addTournoi($tournoi);
    
                $dataJoueurs = $equipeData->getJoueurs();

                
                for ($i = 0; $i < count($dataJoueurs); $i++) {
                    
                    $joueur->setIdEquipe($equipe);
                    
                    $joueur->setNom($dataJoueurs[$i]->getNom());
                    $joueur->setPrenom($dataJoueurs[$i]->getPrenom());
                    $joueur->setDateNaissance($dataJoueurs[$i]->getDateNaissance());
                    
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
