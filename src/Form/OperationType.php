<?php

namespace App\Form;

use App\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_customer')
            ->add('email_user')
            ->add('num_command')
            ->add('email_customer')
            ->add('description', TextareaType::class, ['attr' => ['class' => "description"]])
            ->add('type_operation', ChoiceType::class, ['choices' => [

                'PETITE' => 'PETITE',
                'MOYENNE' => 'MOYENNE',
                'GROSSE' => 'GROSSE'
            ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
