<?php

namespace App\Form;

use App\Entity\Laptop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class LaptopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Laptop Name',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 30
                ]
            ])
            ->add('date', DateType::class, [
                'label' => 'Date of Product',
                'widget' => 'single_text'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Price',
                'currency' => 'USD'
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantity',
                'attr' => [
                    'min' => 1,
                    'max' => 100
                ]
            ])
            ->add('color', ChoiceType::class, [
                'label' => 'Choose Device Color',
                'choices' => [
                    'Red' => 'Red',
                    'Starlight' => 'Starlight',
                    'Midnight' => 'Midnight',
                    'Blue' => 'Blue',
                    'Pink' => 'Pink',
                    'Mint' => 'Mint'
                ],
                'multiple' => false,
                'expanded' => false
            ])
            ->add('image' ,TextType::class,
            [
                'label' => 'Image of Device',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Laptop::class,
        ]);
    }
}
