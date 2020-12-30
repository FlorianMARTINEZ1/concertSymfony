<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Picture;
use App\Entity\ShowList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom du groupe'
            ])
            ->add('Style', TextType::class, [
                'label' => 'Style du groupe'
            ])
            ->add('YearOfCreation', DateType::class, [
                'widget' =>'choice',
                'format' => 'dd / MM / yyyy',
                'label' => 'Date de création'
            ])
            ->add('LastAlbumName', TextType::class, [
                'label' => 'Nom du dernier album'
            ])
            ->add('Picture', EntityType::class, [
                'class' => Picture::class,
                'choice_label' => 'name',
                'multiple' => false
            ])
            ->add('shows', EntityType::class, [
                'class' => ShowList::class,
                'choice_label' => 'TourName',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Band::class,
        ]);
    }
}
