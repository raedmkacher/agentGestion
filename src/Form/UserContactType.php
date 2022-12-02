<?php

namespace App\Form;

use App\Entity\UserContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phonePrefix')
            ->add('phoneNumber')
            ->add('landlinePrefix')
            ->add('landlineNumber')
            ->add('agents')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserContact::class,
        ]);
    }
}
