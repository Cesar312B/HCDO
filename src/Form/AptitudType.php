<?php

namespace App\Form;

use App\Entity\Consulta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AptitudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          
            ->add('tipo_aptitud',ChoiceType::class,[
                'label'=>'Aptitud Médica',
                'placeholder'=>'Escoga una Opción',
                'choices'=>[
                 'Apto' => 'Apto',
                 'Apto en Observación' => 'Apto en Observación',
                 'Apto con Limitaciones' => 'Apto con Limitaciones',
                 'No Apto' => 'No Apto',
                ]
            ])
            ->add('observaciones',TextType::class,[
                'label'=>'Observaciones',
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('limitaciones',TextType::class,[
                'label'=>'Limitaciones',
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
