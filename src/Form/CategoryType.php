<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'label' => 'Category',
                'choices' => [
                    'Laptop' => 'Laptop',
                    'Ultraportable' => 'Ultraportable',
                    'Ultrabook' => 'Ultrabook',
                    'Chromebook' => 'Chromebook',
                    'MacBook' => 'MacBook',
                    'Convertible' => 'Convertible',
                    'Tablet' => 'Tablet',
                    'Netbook' => 'Netbook'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
