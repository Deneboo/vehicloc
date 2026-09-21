<?php

namespace App\Form;

use App\Entity\Car;
use App\Enum\CarMotor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Polyfill\Intl\Icu\NumberFormatter;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom',
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description',
            ])
            ->add('monthly_price', MoneyType::class, [
                'required' => true,
                'label' => 'Prix mensuel',
                'currency' => '€',
                'scale' => 2,
                'rounding_mode' => NumberFormatter::ROUND_HALFEVEN,
                'html5' => true,
            ])
            ->add('daily_price', MoneyType::class, [
                'required' => true,
                'label' => 'Prix par jour',
                'currency' => '€',
                'scale' => 2,
                'rounding_mode' => NumberFormatter::ROUND_HALFEVEN,
                'html5' => true,
            ])
            ->add('places', ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => array_combine(range(1, 9), range(1, 9)),
                'data' => 5,
            ])
            ->add('motor', EnumType::class, [
                'class' => CarMotor::class,
                'data' => CarMotor::Manual,
                'label' => 'Type de moteur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
