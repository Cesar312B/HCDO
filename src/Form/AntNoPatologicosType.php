<?php

namespace App\Form;

use App\Entity\AntNoPatologicos;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class AntNoPatologicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deporte_select',ChoiceType::class,[
                'label'=>'Realiza Actividad Física',
                'placeholder'=>'¿Practica Deportes?',
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('actividad_fisica',TextType::class,[
                'label'=>'Actividad Física',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('numero_actividad_fisica',ChoiceType::class,[
                 'label'=>'Frecuencia de Actividad',
                 'required' => false,
                 'placeholder'=>'Frecuencia',
                 'choices'=>[
                 'Diario' => 'DIARIO',
                 'Semanal' => 'SEMANAL',
                 'Quincenal' => 'QUINCENAL',
                 'Mensual' => 'MENSUAL',
                 'Ocasional' => 'OCASIONAL',
                ]
            ])

            ->add('sustancia_selec',ChoiceType::class,[
                'label'=>'Consumo de Alcohol',
                'placeholder'=>'Consume alcohol?',
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('tiempo_consumo_a',ChoiceType::class,[
                'label'=>'Frecuencia',
                'placeholder'=>'Frecuencia',
                'required' => false,
                'choices'=>[
                    'Diario' => 'DIARIO',
                    'Semanal' => 'SEMANAL',
                    'Quincenal' => 'QUINCENAL',
                    'Mensual' => 'MENSUAL',
                    'Ocasional' => 'OCASIONAL',
                   ]
            ])

            ->add('cantidad_a',NumberType::class,[
                'label'=>'Tiempo de consumo(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('exconsumidor_a',ChoiceType::class,[
                'label'=>'Exconsumidor',
                'placeholder'=>'Es Exconsumidor?',
                'required' => false,
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('tiempo_abstinencia_a',NumberType::class,[
                'label'=>'Tiempo de Abstinencia(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])
            
            ->add('tabaco',ChoiceType::class,[
                'label'=>'Consumo de Tabaco',
                'placeholder'=>'Consume tabaco?',
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('tiempo_consumo',ChoiceType::class,[
                'label'=>'Frecuencia',
                'placeholder'=>'Frecuencia',
                'required' => false,
                'choices'=>[
                    'Diario' => 'DIARIO',
                    'Semanal' => 'SEMANAL',
                    'Quincenal' => 'QUINCENAL',
                    'Mensual' => 'MENSUAL',
                    'Ocasional' => 'OCASIONAL',
                   ]
            ])

            ->add('cantidad',NumberType::class,[
                'label'=>'Tiempo de consumo(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])

            ->add('exconsumidor',ChoiceType::class,[
                'label'=>'Exconsumidor',
                'placeholder'=>'Es Exconsumidor?',
                'required' => false,
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])

            ->add('tiempo_abstinencia',NumberType::class,[
                'label'=>'Abstinencia(Años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),

            ])

            ->add('uso_sustancias',ChoiceType::class,[
                'label'=>'Consumo de Drogas',
                'placeholder'=>'Consume Drogas?',
                'choices'=>[
                    'Si' => 'SI',
                    'No' => 'NO',
                ]

            ])

            ->add('droga_descripcion',TextType::class,[
                'label'=>'Tipo de Droga',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
            ])
            
            /*Consumo de Drogas*/
            ->add('tiempo_consumo_d',ChoiceType::class,[
                'label'=>'Frecuencia',
                'placeholder'=>'Frecuencia',
                'required' => false,
                'choices'=>[
                    'Diario' => 'DIARIO',
                    'Semanal' => 'SEMANAL',
                    'Quincenal' => 'QUINCENAL',
                    'Mensual' => 'MENSUAL',
                    'Ocasional' => 'OCASIONAL',
                   ]
            ])

            ->add('numero_sustancias',NumberType::class,[
                'label'=>'Tiempo de consumo(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
                
            ])
            
            ->add('ex_consumidor',ChoiceType::class,[
                'label'=>'Exconsumidor',
                'placeholder'=>'Es Exconsumidor?',
                'required' => false,
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('tiempo_abstinencia_d',NumberType::class,[
                'label'=>'Abstinencia(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])
            
            ->add('medicamento_select',ChoiceType::class,[
                'label'=>'Consumo de Medicamentos',
                'placeholder'=>'Consume medicamento habitualmente?',
                'choices'=>[
                 'Si' => 'SI',
                 'No' => 'NO',
                ]
            ])
            ->add('medicacion_abitual',TextType::class,[
                'label'=>'Medicación Habitual',
                'required' => false,
            ])
            ->add('cantdad_medicacion',NumberType::class,[
                'label'=>'Años de Consumo',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AntNoPatologicos::class,
        ]);
    }
}
