<?php
/**
 * Created by PhpStorm.
 * User: Yonko
 * Date: 11-Jan-19
 * Time: 1:06 AM
 */

namespace AppBundle\Form;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\WeekPlan;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeekPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userId', TextType::class)
            ->add('monday', TextType::class)
            ->add('tuesday', TextType::class)
            ->add('wednesday', TextType::class)
            ->add('thursday', TextType::class)
            ->add('friday', TextType::class)
            ->add('saturday', TextType::class)
            ->add('sunday', TextType::class);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => WeekPlan::class,));
    }
}