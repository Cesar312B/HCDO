<?php

namespace App\Form;

use App\Entity\Examenes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class ExamenesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre_examen',ChoiceType::class,[
                'required' => false,
                'label'=>'Tipo de muestra',
                'placeholder'=>'Seleccione un tipo de examen',
                'choices'=>[
                 'ORINA' => 'ORINA',
                 'HECES' => 'HECES',
                 'BIOPSIA' => 'BIOPSIA',
                 'SANGRE' => 'SANGRE',
                 'SECRECIONES' => 'SECRECIONES',
                ]

            ])
            ->add('fecha_examen',BirthdayType::class,[
                'years' => range(2017, date("Y")),
                'constraints' => new Range(['max'=>"now"]),
                'required' => false,
                'label'=>'Fecha de Examen',
                'placeholder' => [
                'year' => 'Año', 'month' => 'Mes', 'day' => 'Día',
            ]
            ])
            ->add('resultado_examen',TextType::class,[
                'required' => false,
                'label'=>'Resultados de Exámenes',
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('Observaciones',TextType::class,[
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Examenes::class,
        ]);
    }
}
