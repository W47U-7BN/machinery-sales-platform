<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDocumentFactory extends Factory
{
    protected $model = ProductDocument::class;

    public function definition(): array
    {
        $types = ['application/pdf', 'application/msword', 'application/vnd.ms-excel'];

        return [
            'product_id' => Product::factory(),
            'title' => fake()->randomElement([
                'Brosur Produk',
                'Manual Book',
                'Spesifikasi Teknis',
                'Katalog Produk',
                'Sertifikat Mutu',
                'Garansi',
            ]),
            'file_path' => 'documents/' . fake()->uuid() . '.pdf',
            'file_type' => fake()->randomElement($types),
            'file_size' => fake()->numberBetween(100000, 5000000),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
