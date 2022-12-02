<?php

namespace App\Form;

use App\Entity\Agents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userId')
            ->add('username')
            ->add('fullname')
            ->add('gender')
            ->add('email')
            ->add('emailPec')
            ->add('roles')
            ->add('dateOfBirth')
            ->add('lastLogin')
            ->add('createdAt')
            ->add('active')
            ->add('userAddress')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
