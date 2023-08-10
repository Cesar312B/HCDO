<?php

namespace App\Form;

use App\Entity\CIE;
use App\Entity\DiagnosticoD;
use App\Entity\Piezas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiagnosticoDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('pieza',EntityType::class,[
            'class'=>Piezas::class,
            'required' => true,
            'placeholder'=>'Seleccione una Pieza Dental', 
            'group_by' => function (Piezas $country) {
                    
                return $country->getTipo();
           
             },
            'choice_label'=>'numero',
        ])

        ->add('cie',EntityType::class,[
            'label'=>'Clasificación Internacional de Enfermedades CIE',
            'placeholder'=>'Seleccione una Enfermedad',
            'class'=>CIE::class,
            'choice_label'=>function (CIE $materia) {
                return  $materia->getCodigo(). ': ' . $materia->getDescripcion();},
            'attr' => ['data-select' => 'true']
        ])

        ->add('simbologia',ChoiceType::class,[
            'choices'=>[
                'caries'=>'caries',
                'sellante'=>'sellante',
                'extracción'=>'extracción',
                'perdida'=>'perdida',
                'protesis total'=>'protesis total',
                'endodoncia'=>'endodoncia',
                'corona'=>'corona',
                'protesis fija'=>'protesis fija',
                'protesos removible'=>'protesis removible'
            ],
            'attr' => ['class' => 'simbologia-select']
        ])
            
        ->add('lado', ChoiceType::class, [
            'label'=> 'Lados de la Pieza Dental',
            'required' => false,
            'placeholder' => 'Elige un lado',
            'choices' => [
                'arriba' => 'arriba',
                'abajo' => 'abajo',
                'izquierda' => 'izquierda',
                'derecha' => 'derecha',
                'centro' => 'centro',
                'ninguno'=>''
            ],
            'attr' => [
                'class' => 'lado-select', // Agrega una clase al campo lado
                'style' => 'display: none;' // Oculta el campo lado por defecto
            ],
            'label_attr' => ['class' => 'lado-label'] // Agrega una clase al label del campo lado
        ])
           
            ->add('estado',ChoiceType::class,[
                'choices'=>[
                    'restaurar'=>'restaurar',
                    'restaurado'=>'restaurado'
                ],

            ])
            ->add('tratamiento',TextareaType::class,[
                'required'=>false,

            ])


          
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DiagnosticoD::class,
        ]);
    }
}
