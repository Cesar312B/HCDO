<?php

namespace App\Form;

use App\Entity\AntReproductivos;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class AntReproductivosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menarquia',NumberType::class,[
                'label'=>'Menarquía',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])

            ->add('ciclos',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'Escoja un ciclo menstrual',
                'choices'=>[
                 'NORMAL' => 'NORMAL',
                 'ANORMAL' => 'ANORMAL',
                ]
                
             ])
            ->add('gestas',NumberType::class,[
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('partos',NumberType::class,[
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('abortos',NumberType::class,[
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('hijos',NumberType::class,[
                'constraints' => new Range(['min' =>0]),
            ])
            
            ->add('vida_sexual',ChoiceType::class,[
                'placeholder'=>'Vida Sexual Activa',
                'required' => false,
                'choices'=>[
                 'ACTIVA' => 'ACTIVA',
                 'INACTIVA' => 'INACTIVA',
                ]
                
             ])
            ->add('cesareas',NumberType::class,[
                'label'=>'Cesáreas',
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('ultima_menstruacion',BirthdayType::class,[
                'years' => range(2017, date("Y")),
            'constraints' => new Range(['max'=>"now"]),
               'label'=>'Fecha de la última mestruación',
               'placeholder' => [
                   'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
               ]
             ])
            ->add('ultima_mastografia',ChoiceType::class,[
                'label'=>'Mamografía',
                'placeholder'=>'Se ha realizado una Mamografía?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
            ->add('tiempo_mastografia',NumberType::class,[
                'label'=>'Tiempo Mamografía(años)',
                'required' => false,
             ])

            ->add('resultado_mastografia',TextType::class,[
                'label'=>'Resultado Mamografía',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             ])

            ->add('colposcopia',ChoiceType::class,[
                'label'=>'Colposcopía',
                'placeholder'=>'Se ha realizado una Colposcopía?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
            
            ->add('tiempo_colposcopia',TextType::class,[
                'label'=>'Tiempo Colposcopía(años)',
                'required' => false,
             ])

            ->add('resultado_colposcopia',TextType::class,[
                'label'=>'Resultado Colposcopía',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             ])
            ->add('metodo_planificacion',TextType::class,[
                'label'=>'Método de Planificación Familiar',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             ])

            ->add('papanicolaou',ChoiceType::class,[
                'label'=>'Examen Papanicolao',
                'placeholder'=>'Se ha realizado el examen de Papanicolau?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
             ->add('tiempo_papanicolaou',TextType::class,[
                'label'=>'Tiempo Papanicolaou(años)',
                'constraints' => new Range(['min' =>0]),
                'required' => false,
             ])

             ->add('resultado_papanicolaou',TextType::class,[
                'label'=>'Resultado Papanicolaou',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             ])

            
             ->add('eco_mamario',ChoiceType::class,[
                'label'=>'Examen Eco mamario',
                'placeholder'=>'Se ha realizado el examen Eco Mamario?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
             ->add('tiempo_ecomamario',NumberType::class,[
                'label'=>'Tiempo Ecomamario(años)',
                'required' => false,
                'constraints' => new Range(['min' =>0]),
            ])
             ->add('resultado_ecomamario',TextType::class,[
                'label'=>'Resultado EcoMamario',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             
             ])

             ->add('antigeno_prostatico',ChoiceType::class,[
                'label'=>'Examen Antígeno Prostático',
                'placeholder'=>'Se ha realizado el examen Antígeno Prostático?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
             ->add('tiempo_antigenoprostatico',TextType::class,[
                'label'=>'Tiempo Antigeno Prostatico(años)',
                'required' => false,
             ]
             )
             ->add('resultado_antigenoprostatico',TextType::class,[
                'label'=>'Resultado Antigeno Prostatico',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
             ])

             ->add('eco_prostatico',ChoiceType::class,[
                'label'=>'Examen Eco Prostático',
                'placeholder'=>'Se ha realizado el examen Eco Prostático?',
                'required' => false,
                'choices'=>[
                 'SI' => 'SI',
                 'NO' => 'NO',
                ]
             ])
             ->add('tiempo_ecoprostatico',NumberType::class,[
                'label'=>'Tiempo Eco Prostático(años)',
                'constraints' => new Range(['min' =>0]),
                'required' => false,
             ])
             ->add('resultado_ecoprostatico',TextType::class,[
             'label'=>'Resultado Eco Prostático',
             'required' => false,
             'attr' => ['class' => 'text-uppercase' ],
             ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AntReproductivos::class,
        ]);
    }
}
