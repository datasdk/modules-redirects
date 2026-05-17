<?php

namespace Modules\Redirect\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Redirect\Models\DeviceRedirect;

class DeviceRedirectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeviceRedirect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => strtolower($this->faker->word), // Generer et tilfældigt navn
            'platform' => $this->faker->randomElement(['android', 'ios', 'web']), // Vælg en tilfældig platform
            'url' => $this->faker->url, // Generer en tilfældig URL
        ];
    }
}
