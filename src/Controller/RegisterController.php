<?php

namespace App\Controller;


use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class RegisterController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {      
        $this->passwordEncoder = $passwordEncoder;        
    }
    /**
     * registerAction
     * 
     * formulario de registro y redirige a la pagina de perfil (no se loggea después del registro así que salta el formulario de login)
     *
     * @param  mixed $request
     * @param  mixed $passwordEncoder codifica la contraseña
     * @return void
     *
     * @Route("/register", name="user_registration")
     */ 
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) Construimos el formulario
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) Manejamos el envío (sólo pasará con POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            // 3) Codificamos el password (también se puede hacer a través de un Doctrine listener)
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // 4) Guardar el User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... hacer cualquier otra cosa, como enviar un email, etc
            // establecer un mensaje "flash" de éxito para el usuario

            return $this->redirectToRoute('perfil');
        }

        return $this->render(
            'register/register.html.twig',
            array('form' => $form->createView())
        );
    }
}