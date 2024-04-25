<?php

namespace App\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class DateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('startDate', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'choice',
            ])
        ;
    }
}