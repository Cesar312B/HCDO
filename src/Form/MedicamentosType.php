<?php

namespace App\Form;

use App\Entity\Medicamentos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('descripcion')
            ->add('principio_activo')
            ->add('laboratorio')
            ->add('fraccion', ChoiceType::class, [
                'placeholder'=>'Seleccione si se puede fraccionar',
                'required' => true,
                'multiple' => false,
                'expanded' => true,
                'choices'  => [
                    'SI' => 'SI',
                    'NO' => 'NO',
              ],
            ])

            ->add('Clasificacion')
            ->add('Marca')
            ->add('estado_producto')
            ->add('presentacion_producto')
            ->add('mercado')
            ->add('iva')
            ->add('generico')
            ->add('portafolio_cat')
            ->add('observaciones')
            ->add('year')
            
            ;
            
            }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicamentos::class,
        ]);
    }
}
