<?php
/**
 * Created by PhpStorm.
 * User: Yonko
 * Date: 11-Jan-19
 * Time: 1:06 AM
 */

namespace AppBundle\Form;
use AppBundle\Entity\DayPlan;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DayPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('breakfast', TextType::class)
            ->add('snack1', TextType::class)
            ->add('dinner1', TextType::class)
            ->add('snack2', TextType::class)
            ->add('dinner2', TextType::class);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => DayPlan::class,));
    }
}