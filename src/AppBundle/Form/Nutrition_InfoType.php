<?php

namespace AppBundle\Form;

use AppBundle\Entity\Raw;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Nutrition_InfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kcal', TextType::class)
            ->add('fats', TextType::class)
            ->add('proteins', TextType::class)
            ->add('carbs', TextType::class)
            ->add('unSaturatedFats', TextType::class)
            ->add('saturatedFats', TextType::class)
            ->add('sugars', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Nutrition_InfoType::class,));

    }


}
