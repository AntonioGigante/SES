<?php
namespace App\Controller;

use App\Entity\Campeonato;
use App\Entity\Participacion;
use App\Form\CampeonatoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;    
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController{
        /**
         * index
         *
         * @return void
         * 
         * @Route("/", name="home");
         * @Method("{GET}")
         */        
        public function index(){
          $campeonatosRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('App:Campeonato');
          $campeonato = $campeonatosRepository->findAll();
          return $this->render('main/index.html.twig',['campeonatos' => $campeonato]);
        }

        /**
         * crearCampeonato
         *
         * @param  mixed $request
         * @return Response
         * 
         * @Route("/nuevo_campeonato", name="nuveoCampeonato", methods={"GET", "POST"})
         * @IsGranted("IS_AUTHENTICATED_FULLY") el usuario tiene que estar loggeado para usaar este metodo
         */        
        
        public function crearCampeonato(Request $request): Response
        {
          $campeonato = new Campeonato();
          $form = $this->createForm(CampeonatoType::class, $campeonato);

          $form->handleRequest($request);

          if($form-> isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campeonato);
            $entityManager->flush();

            return $this->redirectToRoute('home');
          }

          return $this->render('campeonatos/new.html.twig', [
            'campeonato' => $campeonato,
             'form' => $form->createView()
          ]);
        }

        /**
         * campeonatoInfo
         *
         * @param  mixed $campeonatoNombre
         * @return void
         * 
         * @Route("/campeonato_info/{campeonatoNombre}", name="campeonato_info", methods={"GET"})
         */   
        public function campeonatoInfo(Campeonato $campeonatoNombre)
        {
          
          $campeonato =  $this->getDoctrine()->getRepository(Campeonato::class)->find($campeonatoNombre);

          return $this->render('campeonatos/show.html.twig', [
           'campeonato' => $campeonato
        ]);
        }

        /**
         * campeonatoInscripcion
         *
         * @param  mixed $campeonato
         * @return void
         * 
         * @Route("/inscripcion", name="inscripcionCampeonato", methods={"GET", "POST"})
         * @IsGranted("IS_AUTHENTICATED_FULLY")
         */
        
       
        public function campeonatoInscripcion(Participacion $campeonato)
        {
          $user = $this->getUser();

          $em = $this->getDoctrine()->getManager();
          $campeonatonombre = $em->getRepository(Campeonato::class)->find(Participacion::class, $campeonato);

          $participante = new Participacion();
          $participante->setUser($user);
          $participante->setCampeonato($campeonatonombre);

          $em->persist($participante);
          $em->flush();

          return $this->redirectToRoute('home');
        }
    }