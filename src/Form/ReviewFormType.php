<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', options:[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom*'
                )
            ])
            ->add('firstName', options:[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prénom*'
                )
            ])
            ->add('review', options:[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Avis*'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
