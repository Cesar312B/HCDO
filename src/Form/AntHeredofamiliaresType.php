<?php

namespace App\Form;

use App\Entity\AntHeredofamiliares;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AntHeredofamiliaresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Patologia',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'Seleccione el grupo de Patología',
                'choices'=>[
                    'ENFERMEDAD CARDIO-VASCULAR' => 'ENFERMEDAD CARDIO-VASCULAR',
                    'ENFERMEDAD METABÓLICA' => 'ENFERMEDAD METABÓLICA',
                    'ENFERMEDAD NEUROLÓGICA' => 'ENFERMEDAD NEUROLÓGICA',
                    'ENFERMEDAD ONCOLÓGICA' => 'ENFERMEDAD ONCOLÓGICA',
                    'ENFERMEDAD INFECCIOSA' => 'ENFERMEDAD INFECCIOSA',
                    'ENFERMEDAD HEREDITARIA / CONGÉNITA' => 'ENFERMEDAD HEREDITARIA / CONGÉNITA',
                    'DISCAPACIDADES' => 'DISCAPACIDADES',
                    'OTROS' => 'OTROS',
                    'NINGUNA' => 'NINGUNA'
                   ]

            ])  
            ->add('descripcion',TextType::class,[
                'label'=>'Descripción de la Enfermedad',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('Parentesco',ChoiceType::class,[
                'required' => true,
                'placeholder'=>'Seleccione un Parentesco',
                'choices'=>[
                    'PADRE' => 'PADRE',
                    'MADRE' => 'MADRE',
                    'ABUELO/A' => 'ABUELO/A',
                    'HERMANO/A' => 'HERMANO/A',
                    'TIO/A' => 'TIO/A',
                    'PRIMO/A' => 'PRIMO/A',
                    'NO APLICA' => 'NO APLICA',

                   ]

            ])

          
        ;


        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AntHeredofamiliares::class,
        ]);
    }
}
