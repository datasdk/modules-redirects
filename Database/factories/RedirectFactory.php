<?php

namespace Modules\Redirect\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Redirect\Models\Redirect;

class RedirectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Redirect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, // Generer et tilfældigt navn
            'url' => $this->faker->url,  // Generer en tilfældig URL
        ];
    }
}
