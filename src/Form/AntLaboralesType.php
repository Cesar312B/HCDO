<?php

namespace App\Form;

use App\Entity\AntLaborales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Range;

class AntLaboralesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('empresa',TextType::class,[
            'label'=>'Empresa',
            'required' => false,
            'attr' => ['class' => 'text-uppercase' ],
        ])
        ->add('puesto_trabajo',TextType::class,[
            'label'=>'Puesto de Trabajo',
            'required' => false,
            'attr' => ['class' => 'text-uppercase' ],
        ])
        ->add('actividades',TextType::class,[
            'label'=>'Actividades',
            'required' => false,
            'attr' => ['class' => 'text-uppercase' ],
        ])
        ->add('tiempo_trabajo',NumberType::class,[
            'label'=>'Tiempo de Trabajo',
            'constraints' => new Range(['min' => 0,'max'=>90]),
        ])
        ->add('riesgo',ChoiceType::class,[
            'placeholder'=>'Seleccione el riesgo',
            'required' => false,
            'multiple' => true,
            'expanded' => true,
            'choices'=>[
             'Físico' => 'Fisico',
             'Químico' => 'Quimico',
             'Biológico' => 'Biologico',
             'Mecánico' => 'Mecanico',
             'Ergonómico' => 'Ergonomico',
             'Psicosocial' => 'Psicosocial',
            ]
        ])
        ->add('ac_trabajo',ChoiceType::class,[
            'label'=>'Accidente Laboral',
            'placeholder'=>'Calificación del IESS',
            'required' => false,
            'multiple' => false,
            'expanded' => false,
            'choices'=>[
             'Si' => 'SI',
             'No' => 'NO',
            ]

        ])
        ->add('descripcion_accidentes',TextType::class,[
            'required' => false,
            'label'=>'Descripción de  Accidente Laboral',
            'attr' => ['class' => 'text-uppercase' ],
        ])
        ->add('fecha_accidente', BirthdayType::class, [
            'required' => false,
            'label'=>'Fecha de Accidente Laboral',
            'placeholder' => 'Seleccione una fecha',
            'years' => range(1990, date("Y")),
            'constraints' => new Range(['max'=>"now"]),
            'placeholder' => [
                'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
            ]
        ])
        ->add('observaciones',TextareaType::class,[
            'required' => false,
            'label'=>'Observaciones',
            'attr' => ['class' => 'text-uppercase' ],
            
        ])
        ->add('enferemedad',ChoiceType::class,[
            'label'=>'Enfermedad Laboral',
            'placeholder'=>'Calificación del IESS',
            'required' => false,
            'multiple' => false,
            'expanded' => false,
            'choices'=>[
             'Si' => 'Si',
             'No' => 'No',
            ]
        ])
        ->add('descripcion_emfermedad',TextType::class,[
            'required' => false,
            'label'=>'Descripción de Enfermedad Laboral',
            'attr' => ['class' => 'text-uppercase' ],
            
        ])

        ->add('fecha_enfermedad', BirthdayType::class, [
            'required' => false,
            'label'=>'Fecha de Enfermedad Laboral',
            'placeholder' => 'Seleccione una fecha',
            'years' => range(1990, date("Y")),
            'constraints' => new Range(['max'=>"now"]),
            'placeholder' => [
                'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
            ]
        ])

        ->add('ob_enfermedades',TextareaType::class,[
            'required' => false,
            'label'=>'Observaciones',
            'attr' => ['class' => 'text-uppercase' ],
            
        ])
        ->add('act_extra',TextType::class,[
            'required' => false,
            'label'=>'Actividades Extra',
            'attr' => ['class' => 'text-uppercase' ]
            
        ])
        ;


             // Data transformer
             $builder->get('riesgo')
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
            'data_class' => AntLaborales::class,
        ]);
    }
}
