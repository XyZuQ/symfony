<?php
/**
 *  Category form
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Constraint;

/**
 * Form type for Category entity.
 */
class CategoryType extends AbstractType
{
    /**
     * Builds the form for the Category entity.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options for the form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Category Name',
                'required' => true,
                'constraints' => [
                    new Constraint\NotBlank(),
                    new Constraint\Length(['max' => 127]),
                ],
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'name',
                'label' => 'Events',
                'multiple' => true,
                'by_reference' => false,
                'expanded' => false,
                'constraints' => [
                    new Constraint\NotBlank(),
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
