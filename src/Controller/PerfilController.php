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
    
        
 
   
}
