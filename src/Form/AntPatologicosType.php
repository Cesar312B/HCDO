<?php

namespace App\Form;

use App\Entity\AntPatologicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AntPatologicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('enfermedad_actual',TextType::class,[
                'required' => false,
                'label'=>'Enfermedad Actual', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('piel_anexos',TextType::class,[
                'required' => false,
                'label'=>'Piel-Anexos ', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('organos_sentidos',TextType::class,[
                'required' => false,
                'label'=>'Órganos de los sentidos', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('respiratorio',TextType::class,[
                'required' => false,
                'label'=>'Respiratorio', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('cardiovascular',TextType::class,[
                'required' => false,
                'label'=>'Cardio-vascular', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('digestivo',TextType::class,[
                'required' => false,
                'label'=>'Digestivo', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('genito_urinario',TextType::class,[
                'required' => false,
                'label'=>'Génito-Urinario', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('musculo_esqueletico',TextType::class,[
                'required' => false,
                'label'=>'Músculo Esquelético', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('endocrino',TextType::class,[
                'required' => false,
                'label'=>'Endócrino', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('hemolinfatico',TextType::class,[
                'required' => false,
                'label'=>'Hemo linfático', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('nervioso',TextType::class,[
                'required' => false,
                'label'=>'Nervioso', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
            ->add('observaciones',TextType::class,[
                'required' => false,
                'label'=>'Observaciones', 
                'attr' => ['class' => 'text-uppercase' ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AntPatologicos::class,
        ]);
    }
}
