<?php

namespace App\Form;

use App\Entity\Piezas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PiezasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero')
            ->add('tipo',ChoiceType::class,[
                'choices'=>[
                    'Incisivos' => 'Incisivos',
                    'Caninos' => 'Caninos',
                    'Premolares'=>'Premolares',
                    'Molares'=>'Molares',
                    'Muelas del juicio'=>'Muelas del juicio'
                 
                   ]
            ])
            ->add('edad',ChoiceType::class,[
                'choices'=>[
                    'Adultos'=>'Adultos',
                    'Niños'=>'Niños'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piezas::class,
        ]);
    }
}
