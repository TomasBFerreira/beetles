<?php

namespace App\Form;

use App\Entity\Beetle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Relationship;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
            ->add('picture', FileType::class, [
                'label' => 'Picture',
                'mapped' => false,
                'required' => false,
            ])
            ->add('relationship', EntityType::class, [
                'class' => Relationship::class,
                'label' => 'Relationship',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Beetle::class,
        ]);
    }
}
