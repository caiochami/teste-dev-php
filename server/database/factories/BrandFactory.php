<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));
        return [
            'name' => $this->faker->vehicleBrand
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Brand $brand) {
            Car::factory()->for($brand)->count($this->faker->numberBetween(1, 5))->create();
        });
    }
}
