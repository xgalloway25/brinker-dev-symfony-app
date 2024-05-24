<?php

namespace App\Form;

use App\Entity\GuestPoints;
use App\Entity\Guest;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestPointsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('guest_id', EntityType::class, ['class' => Guest::class, "choice_label" => "id"])
            ->add('total_points', IntegerType::class, ['attr' => []])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GuestPoints::class,
        ]);
    }
}
