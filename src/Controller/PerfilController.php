<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;     
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PerfilController extends AbstractController
{
    /**
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
