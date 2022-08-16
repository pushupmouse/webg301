<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Brand Name',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 20
                ]
            ])
            ->add('dateFounded', DateType::class, [
                'label' => 'Foundation Date of the Brand',
                'widget' => 'single_text'
            ])
            ->add('image', TextType::class, [
                'label' => 'Image of the Brand',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
