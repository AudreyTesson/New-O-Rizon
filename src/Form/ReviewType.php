<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use PharIo\Manifest\Email;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', EntityType::class, [
                "class" => User::class,
                'choice_label' => 
                'username'
            ])
            ->add('content', TextareaType::class, [
                "label" => "Votre commentaire : ",
                "attr" => [
                    "placeholder" => "J'ai bien aimé cette ville ..."
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'choices'  => [
                    'Excellent' => 5,
                    "Très bon" => 4, 
                    "Bon" => 3,
                    "Peut mieux faire" => 2, 
                    "A éviter" => 1
                ],
                "multiple" => false,
                "expanded" => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
            // 'username' => null
        ]);
    }
}
