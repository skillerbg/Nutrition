<?php
/**
 * Created by PhpStorm.
 * User: Yonko
 * Date: 11-Jan-19
 * Time: 1:06 AM
 */

namespace AppBundle\Form;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\Recipe;
use AppBundle\Entity\Test;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recipe', TestType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Test::class,));
    }
}