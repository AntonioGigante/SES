<?php

namespace App\Form;

use App\Entity\Campeonato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CampeonatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campeonato_nombre', TextType::class)
            //->add('creador_campeonato', TextType::class, ['help' => 'nombre del creador del campeonato'])
            ->add('descripcion', TextType::class)
            ->add('juego', TextType::class)
            ->add('crearcampeonato', SubmitType::class, array('label'=>'crear campeonato'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campeonato::class,
        ]);
    }
}
