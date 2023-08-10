<?php

namespace App\Form;

use App\Entity\Consulta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DNutricionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motivo_nutricional',TextType::class,[
                'label'=>'Motivo de Consulta Nutricional',
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('diagnostico_nutricional',TextType::class,[
                'label'=>'Diagnóstico Nutricional',
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('plan_nutricional',TextareaType::class,[
                'label'=>'Plan Nutricional',
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('recomendaciones',TextareaType::class,[
                'label'=>'Recomendaciones',
                'attr' => ['class' => 'text-uppercase' ],
            ]    
            )
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
