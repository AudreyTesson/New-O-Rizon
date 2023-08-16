<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom', "attr" => ["autocomplete" => "given-name"]])
            ->add('lastname', TextType::class, ['label' => 'Nom', "attr" => ["autocomplete" => "family-name"]])
            ->add('username', TextType::class, ['label' => 'Pseudonyme', "attr" => ["autocomplete" => "nickname"]])
            // ->add('username', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'username',
            // ])
            // ->add('username', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'username',
            // ])
            ->add('email', EmailType::class, [
                "attr" => ["placeholder" => "user@newOrizon.com", "autocomplete" => "current-email"]
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $builder = $event->getForm();
                /** @var User $user */
                $user = $event->getData();

                if ($user->getId() !== null) {
                    // editing profile
                    $builder->add('password', RepeatedType::class, [
                        'type' => PasswordType::class,
                        "mapped" => false,
                        'options' => ['attr' => ['class' => 'password-field', "placeholder" => "••••••••"]],
                        'first_options' => [
                            "label" => "Mot de passe",
                            'attr' => ['class' => 'mt-0 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50', "placeholder" => "••••••••"],
                            'constraints' => [
                                new Regex(
                                    "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
                                    "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                                ),
                            ],
                        ],
                        'second_options' => [
                            'label' => 'Répétez le mot de passe',
                            'attr' => ['class' => 'mt-0 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50', "placeholder" => "••••••••"],
                        ],
                        'invalid_message' => 'Les 2 mots de passe doivent être identiques'
                    ])
                    ;
                } else {
                    // new profile
                    $builder->add('password', RepeatedType::class, [
                        'type' => PasswordType::class,
                        'options' => ['attr' => ['class' => 'password-field']],
                        'first_options' => [
                            "label" => "Mot de passe",
                            'attr' => ['class' => 'mt-0 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50', "placeholder" => "••••••••"],
                            'constraints' => [
                                new NotBlank(['message' => 'Ce champ est obligatoire']),
                                new Regex(
                                    "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
                                    "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                                ),
                            ],
                        ],
                        'second_options' => [
                            'label' => 'Répétez le mot de passe',
                            'attr' => ['class' => 'mt-0 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50', "placeholder" => "••••••••"],
                            ],
                        'invalid_message' => 'Les 2 mots de passe doivent être identiques'
                    ])
                    ;
                }
            });
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
