<?php

namespace App\Form;

use App\Entity\Guest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, ['attr' => []])
            ->add('last_name', TextType::class, ['attr' => []])
            ->add('email', TextType::class, ['attr' => []])
            ->add('phone', TextType::class, ['attr' => []])
            ->add('address', TextType::class, ['attr' => []])
            ->add('city', TextType::class, ['attr' => []])
            ->add('state', TextType::class, ['attr' => []])
            ->add('zip', TextType::class, ['attr' => []])
            ->add('country', TextType::class, ['attr' => []])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guest::class,
        ]);
    }
}
