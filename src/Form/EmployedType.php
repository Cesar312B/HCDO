<?php

namespace App\Form;

use App\Entity\Employed;
use App\Entity\Unidadesoperativas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


class EmployedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Cedula', TextType::class, [
            'label' => 'Cédula',
            'constraints' => [
                new Regex([
                    'pattern' => '/^[0-9,$]*$/',
                    'message' => "El campo solo debe tener números",
                ])
            ],
        ])
        ->add('email', EmailType::class, [
            'label' => 'Correo Electrónico',
        ])
            ->add('Nombre',TextType::class,[
                'label'=>'Nombres Completos', 
            ])
            ->add('Apellido',TextType::class,[
                'label'=>'Apellidos Completos', 
            ])

            ->add('foto',FileType::class,[
                'label' => 'Fotografía del Médico (JPG) 500Kb',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '500k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Porfavor subir una imagen en formato jpg',
                    ])
                ],
           ])

            ->add('Fecha_Ingreso',BirthdayType::class,[
                'label'=>'Fecha de ingreso', 
                'years' => range(1950, date("Y")),
            'constraints' => new Range(['max'=>"now"]),
                    'placeholder' => [
                        'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                       
                    ]
            ])
            ->add('unidadesoperativas',EntityType::class,[
                'required'=>true,
                'class'=>Unidadesoperativas::class,
                'label'=>'Unidad Operativa', 
                'placeholder'=>'Seleccione una Unidad Operativa',
                'choice_label'=>'nombre'
            ])
            ->add('Profesion',TextType::class,[
                'label'=>'Especialidad del Médico', 
            ])

            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                  'Médico' => 'ROLE_MEDICO',
                  'Odontologo' => 'ROLE_ODONTOLOGO',
                ],
            ])
           
            ->add('estado',ChoiceType::class,[
                'choices'=>[
                 'Activo' => 'Activo',
                 'Inactivo' => 'Inactivo',
              
                ]
             ])

         
            ->add('is_active',CheckboxType::class,[

                'required' => false,
                'label'=>'Desbloquear/Bloquear'
                
            ])
        ;

            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employed::class,
            /*
            'constraints' => [
                new UniqueEntity(['fields' => ['Cedula', 'email'], 'message' => 'La cédula o correo ya existen.']),
            ],*/
        ]);
    }
}
