<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Member;
use App\Entity\Picture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('FirstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('Job', TextType::class, [
                'label' => 'Job'
            ])
            ->add('BirthDate', BirthdayType::class, [
                'widget' => 'choice',
                'format' => 'dd/MM/yyyy',
                'label' => 'Date de naissance'
            ])
            ->add('Picture', EntityType::class, [
                'class' => Picture::class,
                'choice_label' => 'name',
                'multiple' => false
            ])
            ->add('Band', EntityType::class, [
                'class' => Band::class,
                'choice_label' => 'name',
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
