<?php

namespace App\Controller;

use App\Entity\Campeonato;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;     
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PerfilController extends AbstractController
{
    /**
     * perfilPage
     *
     * @return void
     * 
     * muestra el perfil loggeado
     * 
     * @Route("/perfil", name="perfil")
     * @Method("{GET}")
     * @IsGranted("IS_AUTHENTICATED_FULLY") 
     */ 
    public function perfilPage()
    {
        error_log('A perfil Page');
        
        $user = $this->getUser();
        //$users = [];
        error_log('erorr redirect');
        return $this->render('perfil/perfil.html.twig', array('users' => array($user)));
    }
    
    /**
     * miquipo
     * informacion del equipo al que pertenece el usuario loggeado
     * @return void
     * 
     * @Route("/miequipo/", name="miequipo")
     * @Method("{GET}")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */ 
    public function miquipo($nombre)
    {
        //mostrar equipo del usuario logeado
        $user = $this->getUser()->getUsername();
        /*$em = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT * FROM App\Entity\Equipos AS e WHERE e.director = $user'
        );
        $equipo = $em->getResult();*/
        $equipo = $this->getDoctrine()->getRepository(Equipo::class)
        ->find($nombre);
        
        return $this->render('equipo/show.html.twig', ["equipos" => $equipo,
        "users" => $user
        ]);
    }
    
    /**
     * @Route("/abandonarequipo/", name="abandonar")
     * @Method("{GET}")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function abandonarequipo()
    {
        //elimina al usuario loggeado del equipo al que pertenece, si es el director asigna a uno de los miembros como director.
    }
    /**
     * ajustes
     * formulario para modificar informacion del usuario
     * @return void
     * 
     * @Route("/ajsutes/{id}", name="ajustes", methods={"GET", "POST"})
     * IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function ajustes(Request $request, $id): Response
    {
        $user = new User;
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createFormBuilder($user)
            ->add("email", TextType::class)
            ->add("username", TextType::class)
            //->add("password", TextType::class)
            ->add("guardar", SubmitType::class,array('label'=>'Guardar cambios'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->flush();

            return $this->redirectToRoute('perfil');
        }

        return $this->render('perfil/ajustes.html.twig', ['user' => $user, 'form' => $form->createView()]);
    }  
    /**
     * @Route("/misCampeonatos", name="misCampeonatos", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY") 
     */  
    public function misCampeonatos(Request $request)
    {
        $user = $this->getUser()->getUsername();
        $campeonato = $this->getDoctrine()->getRepository(Campeonato::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        $query = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT p FROM App\Entity\Campeonato AS p WHERE EXISTS
            (SELECT o.username FROM App\Entity\User AS o WHERE p.admin = o.username AND o.username = :user)'
            )->setParameter('user', $user);
        $campeonato = $query->getResult();

        $query2 = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT p FROM App\Entity\Campeonato AS p JOIN App\Entity\Participacion AS u WHERE 
            p.id = u.campeonato AND EXISTS
            (SELECT o.username FROM App\Entity\User AS  o WHERE u.user = o.id AND o.username = :user)'
        )->setParameter('user', $user);
        $participaciones = $query2->getResult();

        return $this->render('perfil/misCampeonatos.html.twig', ['campeonatos' => $campeonato, 'participaciones' => $participaciones]);
    }

}
