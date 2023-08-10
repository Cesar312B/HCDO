<?php

namespace App\Form;

use App\Entity\ExamenFisico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExamenFisicoType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('piel',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                 'Cicatrices' => 'Cicatrices',
                 'Tatuajes' => 'Tatuajes',
                 'Piel y Faneras' => 'Piel y Faneras',
                ]
            ])

            ->add('ojos',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Párpados' => 'Parpados',
                'Conjuntivas' => 'Conjuntivas',
                'Pupilas' => 'Pupilas',
                'Córnea' => 'Cornea',
                'Motilidad' => 'Motilidad',
                ]
            ])

            ->add('oido',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'C. auditivo externo' => 'C. auditivo externo',
                'Pabellón' => 'Pabellon',
                'Tímpanos' => 'Tímpanos',
                ]
            ])

            ->add('oro_farinje',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Labios' => 'Labios',
                'Lengua' => 'Lengua',
                'Faringe' => 'Faringe',
                'Amígdalas' => 'Amigdalas',
                'Dentadura' => 'Dentadura',
                ]
            ])
            ->add('nariz',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Tabique' => 'Tabique',
                'Cornetes' => 'Cornetes',
                'Mucosas' => 'Mucosas',
                ]
            ])

            ->add('cuello',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Tiroides / masas' => 'Tiroides / masas',
                'Movilidad' => 'Movilidad',
                ]
            ])

            ->add('torax1',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Mamas' => 'Mamas',
                'Corazón' => 'Corazon',
                'Pulmones' => 'Pulmones',
                'Parrilla Costal' => 'Parrilla Costal',
                ]
            ])
            ->add('abdomen',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Vísceras' => 'Visceras',
                'Pared Abdominal' => 'Pared Abdominal',
                ]
            ])

            ->add('columna',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Flexibilidad' => 'Flexibilidad',
                'Desviación' => 'Desviacion',
                'Dolor' => 'Dolor',
                ]
            ])

            ->add('pelvis',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Pelvis' => 'Pelvis',
                'Genitales' => 'Genitales',
                ]
            ])

            ->add('extremidades',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Vascular' => 'Vascular',
                'Miembros Superiores' => 'Miembros Superiores',
                'Miembros Inferiores' => 'Miembros Inferiores',
                ]
            ])

            ->add('neurologico',ChoiceType::class,[
                'disabled' => true,
                'placeholder'=>'Elija',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                'Fuerza' => 'Fuerza',
                'Sensibilidad' => 'Sensibilidad',
                'Marcha' => 'Marcha',
                'Reflejos' => 'Reflejos',
                ]
            ])
            ->add('observaciones',TextareaType::class,[
                'disabled' => true,
                'label'=>'Observaciones',
                'attr' => ['class' => 'text-uppercase' ],
            ]);

           

           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExamenFisico::class,
        ]);
    }
}
