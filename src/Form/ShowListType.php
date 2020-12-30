<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Hall;
use App\Entity\ShowList;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date', DateType::class, [
                'widget' =>'choice',
                'format' => 'dd / MM / yyyy',
                'label' => 'Date du concert'
            ])
            ->add('TourName', TextType::class, [
                'label' => 'Nom de la tournée'
            ])
            ->add('Band', EntityType::class, [
                'class' => Band::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('Hall', EntityType::class, [
                'class' => Hall::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShowList::class,
        ]);
    }
}
