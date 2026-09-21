<?php

namespace App\Factory;

use App\Entity\Car;
use App\Enum\CarMotor;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Car>
 */
final class CarFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Car::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->randomElement([
                'Peugeot 208',
                'Renault Clio',
                'Citroën C3',
                'Volkswagen Golf',
                'Toyota Yaris',
                'Ford Fiesta',
            ]),
            'description' => self::faker()->sentence(15),
            'daily_price' => self::faker()->randomFloat(2, 30, 150),
            'monthly_price' => self::faker()->randomFloat(2, 500, 2000),
            'motor' => self::faker()->randomElement(CarMotor::cases()),
            'places' => self::faker()->numberBetween(1, 9),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Car $car): void {})
        ;
    }
}
