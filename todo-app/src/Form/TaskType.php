<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Title',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pendente' => 'pendente',
                    'Concluída' => 'concluida',
                ],
                'label' => 'Status',
            ]);
        if (in_array('ROLE_ADMIN', $options['user_roles'], true)) {
            $builder->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'label' => 'Author',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'user_roles' => [],
        ]);
    }
}
