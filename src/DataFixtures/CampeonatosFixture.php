<?php

namespace App\DataFixtures;

use App\Entity\Campeonato;
use App\Entity\Prueba;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class CampeonatosFixture extends BaseFixture
{
   
    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        /*$this->createMany(10, 'main_campeonatos', function($i) {
            $user = new User();
            $prueba = new Prueba();
            $campeonato = new Campeonato();
            $campeonato->setCampeonato(sprintf('campeonato%d', $i));
            $campeonato->setJuego(sprintf('gran turismo', $i));
            //$campeonato->setPruebas($prueba);
            //$campeonato->setParticipantes($user, $i);

            return $campeonato;
        });
        $manager->flush();*/
    }
}