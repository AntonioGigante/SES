<?php
namespace App\Controller;

use App\Entity\Campeonato;
use App\Entity\Participacion;
use App\Entity\User;
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
          $user = $this->getUser()->getUsername();
          $campeonato = new Campeonato();
          $form = $this->createForm(CampeonatoType::class, $campeonato);

          $form->handleRequest($request);

          if($form-> isSubmitted() && $form->isValid()){
            $campeonato->setAdmin($user);
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
         * @Route("/campeonato_info/{id}", name="campeonato_info", methods={"GET"})
         */   
        public function campeonatoInfo(Request $request, $id)
        {
          $user = $this->getDoctrine()->getRepository(User::class)->findAll();
          $campeonato =  $this->getDoctrine()->getRepository(Campeonato::class)->find($id);
          //encontrar participantes en el campeonato que el usuario clicka
          //$participantes = $this->getDoctrine()->getRepository(Participacion::class)->findAll();
          $em= $this->getDoctrine()->getManager();
          $query =$this->getDoctrine()->getManager()
          ->createQuery(
              'SELECT IDENTITY(p.user), u.username FROM App\Entity\Participacion AS p JOIN App\Entity\User AS u
               WHERE p.user = u.id AND EXISTS 
              (SELECT o.id FROM App\Entity\Campeonato AS o WHERE o.id = :id AND o.id = p.campeonato)'
          )->setParameter('id', $campeonato);
          $participantes = $query->getResult();

          return $this->render('campeonatos/show.html.twig', [
           'campeonato' => $campeonato, "participaciones" => $participantes, 'users' => $user
        ]);
        }

        /**
         * campeonatoInscripcion
         *
         * @param  mixed $campeonato
         * @return void
         * 
         * 
         * 
         * @Route("/inscripcion/{id}", name="inscripcionCampeonato", methods={"GET", "POST"})
         * @IsGranted("IS_AUTHENTICATED_FULLY")
         */
        
       
        public function campeonatoInscripcion(Request $request, $id)
        {
          /*al inscribirse seañade una participacion en la tabla participaciones con el id de usuario que
           se inscribe (usuario loggeado) y el id del campeonato al que se apunta*/
          $user = $this->getUser();

          $em = $this->getDoctrine()->getManager();
          $campeonatonombre = $em->getRepository(Campeonato::class)->find($id);

          $participante = new Participacion();
          $participante->setUser($user);
          $participante->setCampeonato($campeonatonombre);

          $em->persist($participante);
          $em->flush();

          return $this->redirectToRoute('home');
        }
    }