<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeetleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lineage', TextType::class, [
                'label' => 'Lineage',
                'required' => false, 
            ])
            ->add('gen', TextType::class, [
                'label' => 'Generation',
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Sex',
                'choices' => [
                    'Male' => 'M',
                    'Female' => 'F',
                ],
                'required' => true, 
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('length', TextType::class, [
                'label' => 'Length',
                'required' => false, 
            ])
            ->add('relationship', RelationshipType::class, [
                'label' => 'Relationship',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Beetle',
        ]);
    }
}
