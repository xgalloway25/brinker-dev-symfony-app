<?php

namespace App\Form;

use App\Entity\Redemption;
use App\Entity\Guest;
use App\Entity\Reward;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RedemptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('guest_id', EntityType::class, ['class' => Guest::class, "choice_label" => "id"])
            ->add('reward_id', EntityType::class, ['class' => Reward::class, "choice_label" => "id"])
            ->add('redemption_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('points_redeemed', IntegerType::class, ['attr' => []])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Redemption::class,
        ]);
    }
}
