<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistrationType extends AbstractType
{
    // Créer un formulaire d'enregistrement d'utilisateur
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['attr' => ['type' => '']])
            ->add('username', TextType::class, ['attr' => ['type' => '']])
            ->add('password', PasswordType::class, ['attr' => ['type' => '']])
            ->add('confirm_password', PasswordType::class, ['attr' => ['type' => '']])
            ->add('nom', TextType::class, ['attr' => ['type' => '']])
            ->add('prenom', TextType::class, ['attr' => ['type' => '']])


            ->add('profil', ChoiceType::class, ['choices' => [
                'EXPERT' => 'EXPERT', 
                'SENIOR' => 'SENIOR', 
                'APPRENTI' => 'APPRENTI',
                ]])
            ->add('civilite', ChoiceType::class, ['choices' => [
                'Sexe' => '',
                'Homme' => 'HOMME', 
                'Femme' => 'FEMME',

                ]])
            ->add('date_naissance', BirthdayType::class, [
                'label' => 'Date of birth',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('adresse', TextType::class, ['attr' => ['type' => '']]);
        // $builder->get('roles')
        //         ->addModelTransformer(new CallbackTransformer(
        //             function ($rolesArray) {
    
        //                 return count($rolesArray) ? $rolesArray[0] : null;
        //             },
        //             function ($rolesString) {
    
        //                 return [$rolesString];
        //             }
        //         ));
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
