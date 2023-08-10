<?php

namespace App\Form;

use App\Entity\Ciudad;
use App\Entity\Pacientes;
use App\Entity\Provincia;
use App\Entity\PuestoTrabajo;
use App\Entity\Unidadesoperativas;
use App\Repository\CiudadRepository;
use App\Repository\ProvinciaRepository;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Range;
class PacientesType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('tipo_identificacion',ChoiceType::class,[
            'label'=>'Tipo de Documento de Identificación',
            'required' => true,
            'placeholder'=>'Tipo de Documento de Identificación',
            'choices'=>[
             'Cédula' => 'Cédula',
             'Pasaporte' => 'Pasaporte',
             
            ]
        ])
        ->add('cedula',TextType::class,[  
                    'label'=>'N-Documento de Identificación',
                    'constraints' => [new Regex([
                        'pattern'=>'/^[0-9,$]|[A-Z]*$/',
                        'message' =>"El campo solo acepta numeros y letras en mayusculas"
                     ])
                ] ])
            ->add('image',FileType::class,[
                'label'=>'Imagen del Paciente', 
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
            ->add('pnombre',TextType::class,[
                'label'=>'Primer Nombre', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('snombre',TextType::class,[
                'label'=>'Segundo Nombre', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('papellido',TextType::class,[
                'label'=>'Primer Apellido', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('sapellido',TextType::class,[
                'label'=>'Segundo Apellido', 
                'attr' => ['class' => 'text-uppercase' ],
            ])

            ->add('email_paciente',EmailType::class,[
                'label'=>'Correo Electrónico', 
            ])
            ->add('celular',TextType::class,[
                'label'=>'Número celular',
                'constraints' => [new Regex([
                    'pattern'=>'/^[0-9,$]*$/',
                    'message' =>"El camapo solo debe tener numeros"
                 ])
            ] ])

            ->add('sexo',ChoiceType::class,[
                'label'=>'Sexo',
                'placeholder'=>'Seleccione sexo',
                'choices'=>[
                 'Hombre' => 'Hombre',
                 'Mujer' => 'Mujer',
                ]
                
             ])
            ->add('fecha_nacimiento',BirthdayType::class,[
                'label'=>'Fecha de Nacimiento',
                'years' => range(1950, date("Y")),
                'constraints' => new Range(['max'=>"now"]),
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                ]
            ])

            ->add('fecha_ingreso',BirthdayType::class,[
                'label'=>'Fecha de Ingreso', 
                'years' => range(2000, date("Y")),
                'constraints' => new Range(['max'=>"now"]),
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                   
                ]
            ])
            ->add('estado_civil',ChoiceType::class,[
                'required' => false,
                'label'=>'Estado Civil',
                'placeholder'=>'Estado Civil',
                'choices'=>[
                 'SOLTERO/A' => 'SOLTERO/A',
                 'CASADO/A' => 'CASADO/A',
                 'VIUDO/A' => 'VIUDO/A',
                 'DIVORCIADO/A' => 'DIVORCIADO/A',
                 'UNION LIBRE' => 'UNION LIBRE',
                ]
                
             ])

            ->add('tipo_sangre',ChoiceType::class,[
                'label'=>'Tipo de sangre',
                'required' => false,
                'placeholder'=>'Tipo de sangre',
                'choices'=>[
                 'A+' => 'A+',
                 'A-' => 'A-',
                 'B+' => 'B+',
                 'B-' => 'B-',
                 'AB+' => 'AB+',
                 'AB-' => 'AB-',
                 'O+' => 'O+',
                 'O-' => 'O-',
                ]
                
             ])

            ->add('discapacidad',ChoiceType::class,[
                'label'=>'Seleccione la Discapacidad',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'=>[
                 'Física' => 'FÍSICA',
                 'Auditiva' => 'AUDITIVA',
                 'Mental' => 'MENTAL',
                 'Intelectual' => 'INTELECTUAL',
                 'Sensorial' => 'SENSORIAL',
                 'Visceral' => 'VISCERAL',
                 'NO' => 'NO',
              
                ]
             ])
            ->add('tipo_discapacidad',TextareaType::class,[
                'label'=>'Descripción de Discapacidad', 
                'required' => false,
            ])
            ->add('religion',ChoiceType::class,[
                'required' => false,
                'label'=>'Religión',
                'placeholder'=>'Religión',
                'choices'=>[
                 'CATÓLICA' => 'CATÓLICA',
                 'EVANGÉLICA' => 'EVANGÉLICA',
                 'TESTIGOS DE JEHOVÁ' => 'TESTIGOS DE JEHOVÁ',
                 'MORMONA' => 'MORMONA',
                 'OTRAS' => 'OTRAS',
                ]
                
             ])

            ->add('identidad_genero',ChoiceType::class,[
                'required' => false,
                'label'=>'Identidad de Género',
                'placeholder'=>'Identidad de Género',
                'choices'=>[
                 'FEMENINO' => 'FEMENINO',
                 'MASCULINO' => 'MASCULINO',
                 'TRANS-FEMENINO' => 'TRANS-FEMENINO',
                 'TRANS-MASCULINO' => 'TRANS-MASCULINO',
                 'NO SABE/NO RESPONDE' => 'NO SABE/NO RESPONDE',
                ]
                
             ])

             ->add('orientacion_sexual',ChoiceType::class,[
                'required' => false,
                'label'=>'Orientación Sexual',
                'placeholder'=>'Orientación Sexual',
                'choices'=>[
                 'LESBIANA' => 'LESBIANA',
                 'GAY' => 'GAY',
                 'BISEXUAL' => 'BISEXUAL',
                 'HETEROSEXUAL' => 'HETEROSEXUAL',
                 'NO SABE/NO RESPONDE' => 'NO SABE/NO RESPONDE',
                ]
                
             ])

             ->add('lateralidad',ChoiceType::class,[
                'required' => false,
                'label'=>'Lateralidad',
                'placeholder'=>'Lateralidad',
                'choices'=>[
                 'DERECHO' => 'DERECHO',
                 'IZQUIERDO' => 'IZQUIERDO',
                 'AMBIDIESTRO' => 'AMBIDIESTRO',
                ]
                
             ])

            
            ->add('Provincia',EntityType::class,[
                'class'=>Provincia::class,
                'placeholder'=>'Provincia de residencia',
                'required' => true,
                'mapped'=> false,
                'query_builder' => function (ProvinciaRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC');
                },
                'group_by' => function (Provincia  $unidad) {
                    
                    return $unidad->getPais();
               
                 },
                'choice_label'=>'nombre',
                'attr' => ['data-select' => 'true']
                
            ])
            ->add('calle_principal',TextType::class,[
                'required' => false,
                'label'=>'Calle Principal',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('calle_secundaria',TextType::class,[
                'required' => false,
                'label'=>'Calle Secundaria',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('sector',TextType::class,[
                'required' => false,
                'label'=>'Sector', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('numero_casa',TextType::class,[
                'required' => false,
                'label'=>'Número de Casa', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            
            

            ->add('etnia',ChoiceType::class,[
                'required' => false,
                'label'=>'Etnia',
                'placeholder'=>'Etnia',
                'choices'=>[
                 'INDÍGENA' => 'INDÍGENA',
                 'AFROECUATORIANO/A' => 'AFROECUATORIANO/A',
                 'MULATO/A' => 'MULATO/A',
                 'MONTUBIO/A' => 'MONTUBIO/A',
                 'MESTIZO/A' => 'MESTIZO/A',
                 'BLANCO/A' => 'BLANCO/A',
                 'NINGUNA' => 'NINGUNA',
                ]
                
            ])   
            ->add('nivel_instruccion',ChoiceType::class,[
                'required' => false,
                'label'=>'Nivel de Instrucción',
                'placeholder'=>'Nivel de Instrucción',
                'choices'=>[
                 'PRIMARIA' => 'PRIMARIA',
                 'SECUNDARIA INCOMPLETA' => 'SECUNDARIA INCOMPLETA',
                 'SECUNDARIA COMPLETA' => 'SECUNDARIA COMPLETA',
                 'TÉCNICO/TECNÓLOGO'=>'TÉCNICO/TECNÓLOGO',
                 'SUPERIOR INCOMPLETO' => 'SUPERIOR INCOMPLETO',
                 'SUPERIOR COMPLETO' => 'SUPERIOR COMPLETO',
                 'CUARTO NIVEL' => 'CUARTO NIVEL',
                 'PHD'=>'PHD'
                 
                ]
            ])
            
            ->add('is_active',ChoiceType::class,[
                'label'=>'Activar/Desactivar Paciente',
                'choices'=>[
                 'Activo' => 'Activo',
                 'Inactivo' => 'Inactivo',
              
                ]
             ])
             ->add('puesto_trabajo',EntityType::class,[
                'required' => true,
                 'class'=>PuestoTrabajo::class,
                 'choice_label'=>'nombre',
                 'attr' => ['data-select' => 'true']
             ])


            ; 

  
            $builder->get('Provincia')->addEventListener(
                FormEvents::POST_SUBMIT,
                function(FormEvent $event){
                   $form = $event->getForm();
                   $form->getParent()->add('Ciudad',EntityType::class,[
                 'class'=>Ciudad::class,
                 'label'=>'Canton',
                 'placeholder'=>'Cantón de Residencia',
                 'required' => true,
                 'query_builder' => function (CiudadRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC');
                },
                 'choice_label'=>'nombre', 
                 'choices'=> $form->getData()->getCiudad(),
                   ]);
    
                });
                
                $builder->addEventListener(
                    FormEvents::POST_SET_DATA,
                    function(FormEvent $event){
                        $form= $event->getForm();
                        $data=$event->getData();
                        $ciudad= $data->getCiudad();
                        if($ciudad){
                            $form->get('Provincia')->setData($ciudad->getProvincia());
                            $form->add('Ciudad',EntityType::class,[
                                'class'=>Ciudad::class, 
                                'label'=>'Canton',
                                'placeholder'=>'Cantón de Residencia',
                                'required' => true,
                                'query_builder' => function (CiudadRepository $er) {
                                    return $er->createQueryBuilder('u')
                                        ->orderBy('u.nombre', 'ASC');
                                },
                                'choices'=>$ciudad->getProvincia()->getCiudad(),
                               
                            ]);
    
                        }else{
                            $form->add('Ciudad',EntityType::class,[
                                'class'=>Ciudad::class, 
                                'required' => true,
                                'label'=>'Canton',
                                'placeholder'=>'Cantón de Residencia',
                                'choices'=>[],
                               
                            ]);
                        }
                    }
    
                );    

        
                
                

                  // Data transformer
               $builder->get('discapacidad')
               ->addModelTransformer(new CallbackTransformer(
                   function ($rolesArray) {
                        // transform the array to a string
                        return count($rolesArray)? $rolesArray[0]: null;
                   },
                   function ($rolesString) {
                        // transform the string back to an array
                        return $rolesString;
                   }
           ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pacientes::class,
        ]);
    }
}
