<?php

namespace AppBundle\Form;

use AppBundle\Entity\Raw;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RawType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('type', TextType::class)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', TextType::class)

            ->add('quantity', TextType::class)
            ->add('picture', TextType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Raw::class,
        ]);    }


}
