<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    protected $model = Produk::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(1,5);
        $slug = Str::slug($name, '-');
        return [
            'kategori_id' => $this->faker->numberBetween(1, 10),
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(20, 30),
            'small_description' => $this->faker->paragraph(5, 10),
            'original_price' => $this->faker->numberBetween(10000, 100000),
            'selling_price' => $this->faker->numberBetween(10000, 100000),
            'cover' => '',
            'popular' => 1,
            'is_active' => 1,
        ];
    }
}
