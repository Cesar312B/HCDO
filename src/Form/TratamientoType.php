<?php

namespace App\Form;

use App\Entity\Medicamentos;
use App\Entity\Tratamiento;
use App\Repository\MedicamentosRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class TratamientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
  

        $builder
        ->add('medicamentos',EntityType::class,[
            'placeholder'=>'Seleccione un Medicamento',
            'label'=>'Medicamentos',
            'class'=>Medicamentos::class,
            'query_builder' => function (MedicamentosRepository $er) {
                return $er->medicamentos2();
            },
            'choice_label'=>function (Medicamentos $materia) {
                return  $materia->getCodigo(). ' : ' . $materia->getDescripcion();
            
            },
            'attr' => ['data-select' => 'true']
        ])
        ->add('presentacion',ChoiceType::class,[
            'required' => false,
            'label'=>'Presentación',
            'choices'=>[
                'TABLETA' => 'TABLETA',
                'AMPOLLETA' => 'AMPOLLETA',
                'CÁPSULA' => 'CÁPSULA',
                'PASTILLA' => 'PASTILLA',
                'JARABE' => 'JARABE',
                'GOTERO' => 'GOTERO',
                'CREMA' => 'CREMA',
                'ÓVULO' => 'ÓVULO',
               ]
            
        ])
            ->add('dosis',ChoiceType::class,[
                'required' => false,
                'label'=>'Dosis',
                'choices'=>[
                    '1/2 TABLETA' => '1/2 TABLETA',
                    '1 TABLETA' => '1 TABLETA',
                    '2 TABLETAS' => '2 TABLETAS',
                    '1 AMPOLLETA' => '1 AMPOLLETA',
                    '2 AMPOLLETAS' => '2 AMPOLLETAS',
                    '1 CÁPSULA' => '1 CÁPSULA',
                    '2 CÁPSULAS' => '2 CÁPSULAS',
                    '1 PASTILLA' => '1 PASTILLA',
                    '2 PASTILLAS' => '2 PASTILLAS',
                    '1 CUCHARADA' => '1 CUCHARADA',
                    '1 GOTA' => '1 GOTA',
                    '2 GOTAS' => '2 GOTAS',
                    '2.5 ML' => '2.5 ML',
                    '5 ML' => '5 ML',
                    '10 ML' => '10 ML',
                    '1 ÓVULO' => '1 ÓVULO',
                    '0.5 MG/G' => '0.5 MG/G',
                    ]
               
            ])
            ->add('frecuencia',ChoiceType::class,[
                'required' => false,
                'label'=>'Frecuencia',
                'choices'=>[
                    'CADA 4 HORAS' => 'CADA 4 HORAS',
                    'CADA 6 HORAS' => 'CADA 6 HORAS',
                    'CADA 8 HORAS' => 'CADA 8 HORAS',
                    'CADA 12 HORAS' => 'CADA 12 HORAS',
                    'CADA 24 HORAS' => 'CADA 24 HORAS',
                                        
                   ]
            ])

            ->add('duracion',ChoiceType::class,[
                'required' => false,
                'label'=>'Duración',
                'choices'=>[
                    '1 DÍA' => '1 DÍA',
                    '2 DÍAS' => '2 DÍAS',
                    '3 DÍAS' => '3 DÍAS',
                    '5 DÍAS' => '5 DÍAS',
                    '7 DÍAS' => '7 DÍAS',
                    '10 DÍAS' => '10 DÍAS',
                    '15 DÍAS' => '15 DÍAS',
                    '30 DÍAS' => '30 DÍAS',
                ]
            ])

            ->add('indicaciones',TextareaType::class,[
                'label'=>'Indicaciones',
                
                'attr' => ['class' => 'text-uppercase' ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tratamiento::class,
        ]);
    }
}
