<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,'max' => 15,
                    ]),
                    new Regex([
                        
                        'pattern'=>'/^(?=.*[a-z])(?=.*\d).{6,}$/i',
                        'message' =>"La contraseña no contien los siguientes valores /^(?=.*[a-z])(?=.*\d).{6,}$/i"
                    
                    ])
                ],
                'label' => 'Nueva Contraseña',
            ],
            'second_options' => [
                'attr' => ['autocomplete' => 'new-password'],
                'label' => 'Repita la contraseña',
            ],
            'invalid_message' => 'Los campos de la contraseña deben coincidir.',
            // Instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
        ])
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
