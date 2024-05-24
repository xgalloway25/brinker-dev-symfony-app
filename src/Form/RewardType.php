<?php

namespace App\Form;

use App\Entity\Reward;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RewardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reward_name', TextType::class, ['attr' => []])
            ->add('description', TextType::class, ['attr' => []])
            ->add('points_required', IntegerType::class, ['attr' => []])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reward::class,
        ]);
    }
}
