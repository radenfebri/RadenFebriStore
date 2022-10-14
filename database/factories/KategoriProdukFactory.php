<?php

namespace Database\Factories;

use App\Models\KategoriProduk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class KategoriProdukFactory extends Factory
{
    protected $model = KategoriProduk::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(1,3);
        $slug = Str::slug($name, '-');
        return [
            'name' => $name,
            'slug' => $slug,
            'image' => '',
            'description' => $this->faker->paragraph(5,6),
            'popular' => 0,
            'is_active' => 1,
        ];
    }
}
