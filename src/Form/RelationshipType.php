<?php
namespace App\Form;

use App\Entity\Relationship;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelationshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('existingRelationship', EntityType::class, [
            'class' => Relationship::class,
            'placeholder' => 'Choose an existing relationship',
            'choice_label' => 'displayProperty',
            'query_builder' => function (EntityRepository $er) {
                return $er->findFilteredRelationships(''); 
            },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'searchTerm' => '', 
        ]);
    }
}