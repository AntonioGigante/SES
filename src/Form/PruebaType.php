<?php

namespace App\Form;

use App\Entity\Prueba;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PruebaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prueba', TextType::class)
            ->add('fecha', DateType::class, ['widget' => 'choice'])
            //->add('campeonato')
            ->add('Agregarprueba', SubmitType::class, array('label' => 'Agregar prueba'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prueba::class,
        ]);
    }
}
