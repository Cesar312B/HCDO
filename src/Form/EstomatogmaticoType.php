<?php

namespace App\Form;

use App\Entity\Estomatogmatico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstomatogmaticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('opciones',ChoiceType::class,[
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'label'=>'Opciones Estomatogmáticas',
                'choices'=>[
                 'LABIOS' => 'LABIOS',
                 'MEJILLAS' => 'MEJILLAS',
                 'MAXILAR SUPERIOR' => 'MAXILAR SUPERIOR',
                 'MAXILAR INFERIOR' => 'MAXILAR INFERIOR',
                 'LENGUA' => 'LENGUA',
                 'PALADAR' => 'PALADAR',
                 'PISO' => 'PISO',
                 'CARRILLOS'=>'CARRILLOS',
                 'GLANDULAS SALIVALES'=>'GLANDULAS SALIVALES',
                 'OROFARINGE'=>'OROFARINGE',
                 'ATM'=>'ATM',
                 'GANGLIOS'=>'GANGLIOS'

                ]
            ])
            ->add('observaciones',TextareaType::class,[
                'label'=>'Observaciones',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estomatogmatico::class,
        ]);
    }
}
