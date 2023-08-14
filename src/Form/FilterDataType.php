<?php

namespace App\Form;

use App\Data\FilterData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $visas = [
            'Visa touriste' => 'voluptatem',
            'Visa nomade' => 'temporibus',
            'Virtual Working Program'=> 'suscipit',
            'Spécial Tourist Visa' => 'sed',
            'Welcome Stamp' => 'saepe',
            'Residencia Temporal Empleados Especializados por cuenta propia' => 'rerum',
            'Work From Bermuda' => 'quod',
            'Long-term visa for remote workers and family' => 'qui',
            'e-Visa' => 'necessitatibus',
            'Antigua Nomad Digital Residence' => 'maxime',
            'Global Citizen Concierge' => 'ipsum',
            'visa Premium' => 'doloremque',
        ];

        $environment = [
            'mer' => 'corrupti',
            'montagne' => 'consequatur',
            'ville' => 'dolorem',
            'campagne' => 'accusantium',
        ];

        $builder
            ->add('electricityLevel', ChoiceType::class, [
                'choices' => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('internetLevel', ChoiceType::class, [
                'choices' => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('sunshineLevel', ChoiceType::class, [
                'choices' => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('housingLevel', ChoiceType::class, [
                'choices' => [
                    'Aucun' => "",
                    'Bas' => "low",
                    'Moyen' => "medium",
                    'Elevé' => "high",
                ],
                'label' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('temperatureMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min °C',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('temperatureMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max °C',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('demographyMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('demographyMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('costMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min €',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('costMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max €',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('areaMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min km²',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('areaMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max km²',
                    'class' => 'text-sm w-20 rounded-lg',
                ]
            ])
            ->add('currencyType', CurrencyType::class, [
                "choices" => [
                    "expanded" => true, 
                    "multiple" => false],
                    'label' => false,
                    'placeholder' => 'Sélectionner', 'required' => true,
            ])
            ->add('timezone', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'N° GMT',
                    'class' => 'text-sm w-20 rounded-lg',
                ],
            ])
            ->add('visaType', ChoiceType::class, [ 
                "choices" => [
                    $visas
                    ],
                "expanded" => true,
                "multiple" => false,
                'label' => false,
            ])
            ->add('visaRequired', CheckboxType::class, [
                "label" => "Visa Requis",
                "required" => false,
            ])
            ->add('language', LanguageType::class, [
                "choices" => [
                    "expanded" => false, 
                    "multiple" => false],
                    'label' => false,
                    'placeholder' => 'Sélectionner', 'required' => true,
            ])
            ->add('environment', ChoiceType::class, [ 
                "choices" => [
                    $environment
                    ],
                "expanded" => true,
                "multiple" => false,
                'label' => false,
            ])
        ;          
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterData::class,
            'method' => 'GET',
            'attr' => ['id' => 'filter_data']
        ]);
    }
}