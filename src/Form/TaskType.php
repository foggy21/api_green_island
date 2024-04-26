<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Group;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('result', HiddenType::class)
            ->add('start_date', HiddenType::class)
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
            ->add('responsible', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])
            ->add('created_by', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])
            ->add('squad', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
