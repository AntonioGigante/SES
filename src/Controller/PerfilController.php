<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;     
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Mime\Email;

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
     * @Route("/miequipo/{nombre}", name="miequipo")
     * @Method("{GET}")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */ 
    public function miquipo($nombre)
    {
        //mostrar equipo del usuario logeado
        $user = $this->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager()
        ->createQuery(
            'SELECT * FROM App\Entity\Equipos WHERE '
        );
        $equipo = $this->getDoctrine()->getRepository(Equipo::class)
        ->find($nombre);

        return $this->render('equipo/show.html.twig', [
           'equipos' => $equipo
        ]);
    }
    
    /**
     * ajustes
     * formulario para modificar informacion del usuario
     * @return void
     * 
     * @Route("/ajsutes/{id}", name="ajustes", methods={"GET", "POST"})
     * IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function ajustes(Request $request, $id)
    {
        $user = new User;
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createFormBuilder($user)
            ->add("email", Email::class)
            ->add("username", TextType::class)
            //->add("password", TextType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->flush();

            return $this->redirectToRoute('perfil');
        }

        return $this->render('perfil/ajustes.html.twig', ['user' => $user, 'form' => $form->createView()]);
    }    
 
   
}
