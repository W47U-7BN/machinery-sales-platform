<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $titles = [
            'Panduan Memilih Mesin Pengolahan Makanan yang Tepat',
            'Tips Perawatan Mesin Industri Agar Awet',
            'Inovasi Teknologi Mesin Packaging Terbaru 2025',
            'Cara Meningkatkan Efisiensi Produksi dengan Conveyor',
            'Memahami Spesifikasi Boiler untuk Industri',
            'Keuntungan Menggunakan Mesin Pertanian Modern',
            'Standar Keamanan Mesin Industri yang Wajib Diketahui',
            'Panduan Memilih Generator Sesuai Kebutuhan',
            'Tren Mesin Farmasi di Era Industri 4.0',
            'Cara Memulai Usaha Pengolahan Makanan Skala UMKM',
        ];

        $title = fake()->unique()->randomElement($titles);

        return [
            'author_id' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $title,
            'slug' => fn(array $attrs) => str($attrs['title'])->slug(),
            'content' => fake()->paragraphs(10, true),
            'excerpt' => fake()->paragraph(),
            'featured_image' => null,
            'tags' => implode(', ', fake()->randomElements(['mesin', 'industri', 'teknologi', 'manufaktur', 'pengolahan', 'boiler', 'packaging', 'pertanian', 'tips'], fake()->numberBetween(2, 5))),
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'meta_title' => fn(array $attrs) => $attrs['title'] . ' | Blog Industri',
            'meta_description' => fn(array $attrs) => $attrs['excerpt'],
        ];
    }

    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
