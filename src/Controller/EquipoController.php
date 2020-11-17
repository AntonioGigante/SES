<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Form\EquipoType;
use App\Repository\EquipoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



/**
 * EquipoController
 */
class EquipoController extends AbstractController
{

    /**
     * @Route("/equipos", name="equipo")
     * @Method("{GET}")
     */
    
    /**
     * index
     *
     * @param  mixed $equipoRepository
     * @return Response
     */
    public function index(EquipoRepository $equipoRepository): Response
    {
        
        return $this->render('equipo/miequipo.html.twig', [
            'equipos' => $equipoRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="equipo_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */    
    /**
     * create
     *
     * @param  mixed $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipo);
            $entityManager->flush();
            

            return $this->redirectToRoute('equipo');
        }

        return $this->render('equipo/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/equipos/{nombre}", name="equipo_show")
     */    
    /**
     * show
     *
     * @param  mixed $nombre
     * @return void
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
     * @Route("/edit/{id}", name="equipo_edit", methods={"GET","POST"})
     */    
    /**
     * edit
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, $id)
    {

        $equipo = new Equipo();
        $equipo = $this->getDoctrine()->getRepository(Equipo::class)->find($id);
  
        $form = $this->createFormBuilder($equipo)
        ->add('Nombre', TextType::class)
        ->add('director', TextType::class)
        ->add('miembros', TextareaType::class)
        /**->add('logo', FileType::class)**/
        ->add('editar', SubmitType::class,array('label'=>'editar'))
          ->getForm();
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('equipo');
        }
  
        return $this->render('equipo/edit.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete{id}", name="equipo_delete", methods={"DELETE"})
     */    
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
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
    }
}
