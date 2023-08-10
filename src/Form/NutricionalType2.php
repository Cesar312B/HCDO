<?php

namespace App\Form;

use App\Entity\Nutricional;
use App\Entity\SubtipoNutricional;
use App\Repository\SubtipoNutricionalRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NutricionalType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('suptipo_nutricional',EntityType::class,[
                'disabled' => true,
                'label'=>'Hábitos nutricionales',
                'placeholder'=>'Seleccione un hábito',
                'class'=>SubtipoNutricional::class,
                'query_builder'=> function(SubtipoNutricionalRepository $er){
                    return $er->createQueryBuilder('m')
                    ->innerJoin('m.tipo_nutricional','p','p.');
                   },
                   'group_by' => function (SubtipoNutricional $country) {
                    
                   return $country->getTipoNutricional()->getTipo();
               
                 },
                'choice_label'=>'sub_tipo',
            ])
            ->add('descripcion_hab',TextareaType::class,[
                'disabled' => true,
                'label'=>'Descripción del hábito',
                'attr' => ['class' => 'text-uppercase' ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nutricional::class,
        ]);
    }
}
