<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class likeFactory extends Factory
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
            'post_id' => function () {
                    
                return \App\Models\Post::factory()->create()->id;
        
            },
            'reaction' => $this->faker->randomElement(['like', 'love', 'care']), // Adjust reactions as needed
            
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
