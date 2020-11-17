<?php

namespace App\DataFixtures;


use App\Entity\Prueba;
use Doctrine\Persistence\ObjectManager;

class PruebasFixture extends BaseFixture
{
   
    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        /*$this->createMany(10, 'main_pruebas', function($i) {
            $prueba = new Prueba();
            $date = new \DateTime();
            $prueba->setCampeonato(sprintf('campeonato%d', $i));
            $prueba->setPrueba(sprintf('prueba%d', $i));
            $prueba->setFecha($date , $i);

            return $prueba;
        });
        $manager->flush();*/
    }
}