<?php

namespace App\Form;

use App\Entity\Actividades;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActividadesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actividad')
            ->add('riesgos',ChoiceType::class,[
                'label'=>'Riegos','placeholder'=>'Seleccione el riesgo',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            'choices'=>[
                'Temperaturas altas' => 'Temperaturas altas',
                'Temperaturas bajas' => 'Temperaturas bajas',
                'Radiación Ionizante' => 'Radiacion Ionizante',
                'Radiación No Ionizante' => 'Radiacion No Ionizante',
                'Ruido' => 'Ruido',
                'Vibración' => 'Vibracion',
                'Iluminación' => 'Iluminacion',
                'Ventilación' => 'Ventilacion',
                'Fluido eléctrico' => 'Fluido electrico',
                'Otros' => 'Otros',
                'Atrapamiento entre máquinas' => 'Atrapamiento entre maquinas',
                'Atrapamiento entre superficies' => 'Atrapamiento entre superficies',
                'Atrapamiento entre objetos' => 'Atrapamiento entre objetos',
                'Caída de objetos' => 'Caida de objetos',
                'Caídas al mismo nivel' => 'Caidas al mismo nivel',
                'Caídas a diferente nivel' => 'Caidas a diferente nivel',
                'Contacto eléctrico' => 'Contacto electrico',
                'Contacto con superficies de trabajos' => 'Contacto con superficies de trabajos',
                'Proyección de partículas –fragmentos' => 'Proyeccion de partículas –fragmentos',
                'Proyección de fluidos' => 'Proyeccion de fluidos',
                'Pinchazos' => 'Pinchazos',
                'Cortes' => 'Cortes',
                'Atropellamientos por vehículos' => 'Atropellamientos por vehiculos',
                'Choques / Colisión vehicular' => 'Choques / Colision vehicular',
                'Otros' => 'Otros',
                'Sólidos' => 'Solidos',
                'Polvos' => 'Polvos',
                'Humos' => 'Humos',
                'líquidos' => 'liquidos',
                'vapores' => 'vapores',
                'Aerosoles' => 'Aerosoles',
                'Neblinas' => 'Neblinas',
                'Gaseosos' => 'Gaseosos',
                'Virus' => 'Virus',
                'Hongos' => 'Hongos',
                'Bacterias' => 'Bacterias',
                'Parásitos' => 'Parasitos',
                'Exposición a vectores' => 'Exposicion a vectores',
                'Exposición a animales selváticos' => 'Exposicion a animales selvaticos',
                'Otros' => 'Otros',
                'Manejo manual de cargas' => 'Manejo manual de cargas',
                'Movimiento repetitivos' => 'Movimiento repetitivos',
                'Posturas forzadas' => 'Posturas forzadas',
                'Trabajos con PVD' => 'Trabajos con PVD',
                'Otros' => 'Otros',
                'Monotonía del trabajo' => 'Monotonia del trabajo',
                'Sobrecarga laboral' => 'Sobrecarga laboral',
                'Minuciosidad de la tarea' => 'Minuciosidad de la tarea',
                'Alta responsabilidad' => 'Alta responsabilidad',
                'Autonomía  en la toma de decisiones' => 'Autonomia  en la toma de decisiones',
                'Supervisión y estilos de dirección deficiente' => 'Supervision y estilos de dirección deficiente',
                'Conflicto de rol' => 'Conflicto de rol',
                'Falta de Claridad en las funciones' => 'Falta de Claridad en las funciones',
                'Incorrecta distribución del trabajo' => 'Incorrecta distribución del trabajo',
                'Turnos rotativos' => 'Turnos rotativos',
                'Relaciones interpersonales' => 'Relaciones interpersonales',
                'Inestabilidad laboral' => 'Inestabilidad laboral',
                'Otros' => 'Otros',
             
               ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actividades::class,
        ]);
    }
}
