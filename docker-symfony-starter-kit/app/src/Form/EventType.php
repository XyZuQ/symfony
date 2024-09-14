<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Constraint;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Event Name',
                'constraints' => [
                    new Constraint\NotBlank(),
                    new Constraint\Length(['max' => 255]),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Constraint\NotBlank(),
                    new Constraint\Length(['max' => 1024]),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateFrom', DateType::class, [
                'label' => 'Date From',
                'widget' => 'single_text',
                'constraints' => [
                    new Constraint\NotBlank(),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateTo', DateType::class, [
                'label' => 'Date To',
                'widget' => 'single_text',
                'constraints' => [
                    new Constraint\NotBlank(),
                ],
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
