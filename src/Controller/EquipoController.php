<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Miembros;
use App\Entity\User;
use App\Form\EquipoType;
use App\Repository\EquipoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class EquipoController extends AbstractController
{

    /**
     * index
     *
     * @param  mixed $equipoRepository repositorio de equipo donde usa el metodo findAll()
     * @return Response
     * 
     * muestra todos los equipos de la tabla equipos en la base de datos
     * 
     * @Route("/equipos", name="equipo")
     * @Method("{GET}")
     */
    
  
    public function index(EquipoRepository $equipoRepository): Response
    {
        
        return $this->render('equipo/miequipo.html.twig', [
            'equipos' => $equipoRepository->findAll()
        ]);
    }

    /**
     * create
     *
     * @param  mixed $request
     * @return Response
     * 
     * @Route("/new", name="equipo_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */    

    public function create(Request $request): Response
    {
        $user = $this->getUser()->getUsername();
        $equipo = new Equipo();
        $userequipo = new User();
        $usermiembro = new Miembros();
        $form = $this->createForm(EquipoType::class, $equipo);

        $form = $this->createFormBuilder($equipo)
        ->add('Nombre', TextType::class)    
        //->add('foto', FileType::class, array('data_class'=>null, 'label'=>'seleciona una imagen', 'required'=>false ))
        ->add('editar', SubmitType::class,array('label'=>'editar'))
          ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Añadir id_usario a la tabla Miembros.            
            //Añadir id_equipo a la tabla de usuarios en el usuario que crea el equipo.
            $em = $this->getDoctrine()->getManager();
            $query = $this->getDoctrine()->getManager()
            ->createQuery(
            'SELECT (p.id) FROM App\Entity\Equipo AS p WHERE EXISTS
            (SELECT o.username FROM App\Entity\User AS o WHERE o.username = p.director)'); 
            $teamsuer = $query->getResult(); 
            
            //set foto del equipo "null" y director del equipo "usuario loggeado". 
            $equipo->setFoto('null', null);
            $equipo->setDirector($user);
            $usermiembro->getEquipo($teamsuer);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipo);
            $entityManager->persist($userequipo);
            $entityManager->flush();

            return $this->redirectToRoute('equipo');
        }

        return $this->render('equipo/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * show
     *
     * @param  mixed $nombre busca el equipo por el nombre 
     * @return void
     * 
     * al hacer click sobre el equipo redirige a otra pagina que muestra la informacion del equipo
     * 
     * @Route("/equipos/{nombre}", name="equipo_show")
     */ 
    
    public function show($nombre)
    {
        
        $equipo = $this->getDoctrine()->getRepository(Equipo::class)
        ->find($nombre);

        return $this->render('equipo/show.html.twig', [
           'equipos' => $equipo
        ]);
    }

    /**
     * 
     * edit
     *
     * @param  mixed $request
     * @param  mixed $id este parametro indica el id del equipo que queremos editar
     * 
     * $form crea el formulario en el cual editaremos el equipo
     * 
     * despues de enviar el formulario redirige a la lista de equipos.
     * 
     * @return void
     * 
     * @Route("/edit/{id}", name="equipo_edit", methods={"GET","POST"})
     */    
    public function edit(Request $request, $id)
    {

        $equipo = new Equipo();
        $equipo = $this->getDoctrine()->getRepository(Equipo::class)->find($id);
  
        $form = $this->createFormBuilder($equipo)
        ->add('Nombre', TextType::class)
        ->add('director', TextType::class)
        //->add('foto', FileType::class, array('data_class'=>null, 'label'=>'seleciona una imagen', 'required'=>false ))
        ->add('editar', SubmitType::class,array('label'=>'editar'))
          ->getForm();
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
            /*$brochureFile = $form->get('foto')->getData();
            if ($brochureFile) {
              $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
              // this is needed to safely include the file name as part of the URL
              $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
              $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
  
              // Move the file to the directory where brochures are stored
              try {
                  $brochureFile->move(
                      $this->getParameter('brochures_directory'),
                      $newFilename
                  );
              } catch (FileException $e) {
                  // ... handle exception if something happens during file upload
              }
  
              // updates the 'brochureFilename' property to store the PDF file name
              // instead of its contents
              $equipo->setFoto($newFilename);
          }*/
  
          // ... persist the $product variable or any other work
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('equipo');
        }
  
        return $this->render('equipo/edit.html.twig',[
          'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete{id}", name="equipo_delete", methods={"DELETE"})
     */
    /**public function delete($id)
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $equipo = $entityManager->getRepository('App\Entity\Equipo')->find($id);

            if (!$equipo) {
                throw $this->createNotFoundException(
                    'There are no articles with the following id: ' . $id
                );
            }

            $entityManager->remove($equipo);
            $entityManager->flush();
        

        return $this->redirectToRoute('/mi_equipo');
    }*/

    
    /**
     * @Route("/join/{id}", name="join", methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function join(Request $request, $id)
    {
        $user  = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $equiponombre = $em->getRepository(Equipo::class)->find($id);

        $equipomiembro = new User();
        $miembro = new Miembros();
        $miembro->setUser($user);
        $equipomiembro->setEquipo($equiponombre);

        $em->persist($miembro);
        $em->persist($equiponombre);
        $em->flush();

        return $this->redirectToRoute('perfil');
    }
}
