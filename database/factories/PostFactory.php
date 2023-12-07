<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                    
                return \App\Models\User::factory()->create()->id;
        
            },
            'content' => $this->faker->text,
            'post_type' => $this->faker->randomElement(['text', 'photo', 'video', 'link']),
            'location' => $this->faker->optional()->address,
            'privacy' => $this->faker->randomElement(['public', 'friends', 'friends_of_friends', 'custom']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
