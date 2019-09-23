<?php

namespace App\Form;

use App\Entity\Cloth;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ClothType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Type', ChoiceType::class, [
            'choices' => [
                'Tshirt' => 'Tshirt',
                'Jogging' => 'Jogging',
                'Basket' => 'Basket',
                'Jean' => 'Jean',
                'Veste' => 'Veste',
                'Casquette' => 'Casquette']])
            ->add('Name')
            ->add('price')
            ->add('note')
            ->add('picture')
            ->add('description')
            ->add('Size')
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cloth::class,
        ]);
    }
}
