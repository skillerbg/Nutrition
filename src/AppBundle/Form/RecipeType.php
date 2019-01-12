<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Recipe;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('type', TextType::class)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', TextType::class)

            ->add('quantity', TextType::class)
            ->add('picture', TextType::class)
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
        $resolver->setDefaults(array('data_class' => Recipe::class,));
    }


}
