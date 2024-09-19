<?php
/**
 *  Contact Form
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Constraint;

/**
 *  Form type for Contact entity.
 */
class ContactType extends AbstractType
{
    /**
     * Builds the form for the Contact entity.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options for the form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'constraints' => [
                    new Constraint\NotBlank([
                        'message' => 'First name cannot be blank.',
                    ]),
                    new Constraint\Length([
                        'max' => 32,
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'constraints' => [
                    new Constraint\NotBlank([
                        'message' => 'Last name cannot be blank.',
                    ]),
                    new Constraint\Length([
                        'max' => 32,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new Constraint\NotBlank([
                        'message' => 'Email cannot be blank.',
                    ]),
                    new Constraint\Email([
                        'message' => 'Please enter a valid email address.',
                    ]),
                    new Constraint\Length([
                        'max' => 64,
                    ]),
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => false,
                'constraints' => [
                    new Constraint\Length([
                        'max' => 12,
                    ]),
                ],
            ])
            ->add('street', TextType::class, [
                'label' => 'Street',
                'required' => false,
                'constraints' => [
                    new Constraint\Length([
                        'max' => 64,
                    ]),
                ],
            ])
            ->add('postCode', TextType::class, [
                'label' => 'Post Code',
                'required' => false,
                'constraints' => [
                    new Constraint\Length([
                        'max' => 10,
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'required' => false,
                'constraints' => [
                    new Constraint\Length([
                        'max' => 64,
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
