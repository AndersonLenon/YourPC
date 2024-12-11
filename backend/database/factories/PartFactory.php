<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'image_path' => $this->faker->imageUrl(640, 480, 'technics', true), // URL de imagem
            'description' => $this->faker->sentence(10), // Descrição curta
            'price' => $this->faker->randomFloat(2, 10, 5000), // Preço entre 10 e 5000
            'purchase_link' => $this->faker->url(), // URL aleatória
            'category' => $this->faker->randomElement(['GPU', 'CPU', 'RAM', 'Motherboard']), // Categorias
            'brand' => $this->faker->randomElement(['Intel', 'AMD', 'NVIDIA', 'Corsair']), // Marcas
            'stock' => $this->faker->numberBetween(0, 100), // Estoque entre 0 e 100
            'rating' => $this->faker->randomFloat(1, 0, 5), // Avaliação entre 0 e 5
            'release_date' => $this->faker->date(), // Data aleatória
            'specs' => json_encode([
                'cores' => $this->faker->numberBetween(2, 16),
                'frequency' => $this->faker->randomFloat(1, 1.5, 4.5) . ' GHz',
                'memory' => $this->faker->numberBetween(2, 16) . ' GB',
            ]), // Especificações fictícias
        ];
    }
}
