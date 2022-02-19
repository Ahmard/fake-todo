<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(10, 5),
            'body' => $this->faker->realText(200),
            'userId' => rand(1, 2)
        ];
    }
}
