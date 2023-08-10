<?php

namespace App\Form;

use App\Entity\Consulta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetiroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('evaluacion_retiro',ChoiceType::class,[
                'label'=>'Se realizo la evaluación?',
                'placeholder'=>'Escoja una opcion',
                'choices'=>[
                 'Si' => 'Si',
                 'No' => 'No',
                 
                ]
            ])
            
  
        ->add('observaciones_retiro',TextType::class,[
            'label'=>'Observaciones',
            'attr' => ['class' => 'text-uppercase' ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
