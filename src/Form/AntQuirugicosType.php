<?php

namespace App\Form;

use App\Entity\AntQuirugicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;

class AntQuirugicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ant_clinico',TextType::class,[
                'required' => false,
                'label'=>'Antecedente clínico', 
                 'attr' => array( 'class' => 'text-uppercase' ), 
                 
              
            ])
            ->add('tratamiento',TextType::class,[
                'required' => false,
                'label'=>'Tratamiento clínico', 
            
                 'attr' => array( 'class' => 'text-uppercase' ), 
                
            ])
            ->add('procedimiento',TextType::class,[
                'required' => false,
                'label'=>'Procedimiento quirúrgico', 
                'attr' => array( 'class' => 'text-uppercase' ), 
               
            
            ])
            ->add('tiempo',NumberType::class,[
                'required' => false,
                'label'=>'Tiempo en Años',
                'constraints' => new Range(['min' =>0]),
            ])
            ->add('complicaciones',TextType::class,[
                'required' => false,
                'label'=>'Complicaciones quirúrgicas',
                'attr' => array( 'class' => 'text-uppercase' ), 
                
            ])

       
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AntQuirugicos::class,
        ]);
    }
}
