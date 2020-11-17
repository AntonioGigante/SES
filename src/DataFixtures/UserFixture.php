<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
   
    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
       
        $this->createMany(10, 'main_users', function($i) {
            $roles = array('ROLE_USER');
            $username = $this->faker->userName;
            $user = new User();
            $user->setEmail($username.'@ses.test');
            $user->setUsername($username);
            $password = $this->encoder->encodePassword($user, 'itsasecret');
            $user->setPassword($password);
            $user->setRoles($roles);
            $user->setVictorias(0);
            $user->setCompeticionesApuntado(0);
            $user->setCompeticionesGanadas(0);

            return $user;
        });
        $manager->flush();
    }
}
