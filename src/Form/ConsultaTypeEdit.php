<?php

namespace App\Form;

use App\Entity\Consulta;
use App\Entity\Employed;
use App\Repository\EmployedRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ConsultaTypeEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('motivo_consulta',ChoiceType::class,[
                'required'=>true,
                'placeholder'=>'Seleccione Motivo de Consulta',
                'choices'=>[
                 'Ingreso' => 'Ingreso',
                 'Periódica' => 'Periódica',
                 'Salida' => 'Salida',
                 'Reingreso' => 'Reingreso',
                 'Dental'=>'Dental'
                ]
            ])
                ->add('descripcion',TextareaType::class,[
                    'required'=>false,
                ])
            ->add('fecha_atencion',DateTimeType::class,[
                'required'=>true,
                'label'=>'Fecha y hora de atención',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Día'
                   
                ]
            ])

            ->getForm()
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
