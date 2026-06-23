<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static array $productNames = [
        'Mesin Penggiling Biji Kopi SG-300',
        'Mesin Roasting Kopi Kapasitas 10kg',
        'Mesin Pembuat Mie Otomatis BM-200',
        'Mesin Mixer Adonan Roti Spiral',
        'Mesin Pengering Gabah Tipe Bakar',
        'Mesin Penggiling Daging Industri TC-32',
        'Mesin Penepung Disk Mill FFC-45',
        'Mesin Extruder Makanan Ringan',
        'Mesin Pengemas Vakum DZ-600',
        'Mesin Packaging Vertikal VFFS-500',
        'Mesin Strapping Band Otomatis',
        'Mesin Shrink Wrap Packaging',
        'Mesin Filling Minuman Sirup',
        'Mesin Pembuat Es Kristal 5 Ton',
        'Mesin Pasteurisasi Susu',
        'Mesin Pendingin Ruangan Chiller',
        'Mesin Pemanas Air Boiler 500L',
        'Traktor Tangan Quick G-300',
        'Mesin Panen Padi Combine Harvester',
        'Mesin Pemotong Rumput Gendong',
        'Mesin Penanam Padi Indojaya',
        'Mesin Pakan Ternak Pelet Apung',
        'Mesin Pencacah Rumput Gajah',
        'Mesin Pemotong Kuku Hewan',
        'Mesin Tetas Telur Otomatis 100 Butir',
        'Kandang Baterai Ayam Petelur',
        'Mesin Pembuat Pakan Ikan Apung',
        'Mesin Aerator Tambak Udang',
        'Pompa Air Tambak 3 Inch',
        'Mesin Pemotong Daging Industri',
        'Mesin Pengolahan Limbah Industri',
        'Mesin Kompresor Udara 10 PK',
        'Mesin Las Listrik 900 Watt',
        'Mesin Bor Industri Magnet',
        'Boiler Kapasitas 2 Ton B-2000',
        'Boiler Steam Kapasitas 5 Ton',
        'Thermic Oil Heater 1 Juta Kkal',
        'Generator Diesel 50 KVA',
        'Generator Silent 30 KVA',
        'Generator Bensin 5000 Watt',
        'Conveyor Belt Industri',
        'Conveyor Screw Pengangkut',
        'Conveyor Roller Gravity',
        'Conveyor Chain Drag',
        'Mesin Pelabelan Botol Semi Otomatis',
        'Mesin Pengisi Kapsul Farmasi',
        'Mesin Tablet Press 16 Punch',
        'Mesin Mixer Farmasi V-Type',
        'Filter Press Industri',
        'Mesin Centrifugal Separator',
    ];

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(static::$productNames);

        return [
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'unit_id' => Unit::factory(),
            'name' => $name,
            'slug' => fn(array $attrs) => str($attrs['name'])->slug(),
            'sku' => 'SKU-' . strtoupper(fake()->bothify('???-####')),
            'barcode' => fake()->ean13(),
            'description' => fake()->paragraphs(3, true),
            'short_description' => fake()->sentence(),
            'specifications' => [
                'Dimensi' => fake()->randomFloat(2, 30, 500) . ' x ' . fake()->randomFloat(2, 20, 400) . ' x ' . fake()->randomFloat(2, 20, 300) . ' cm',
                'Berat' => fake()->numberBetween(10, 5000) . ' kg',
                'Material' => fake()->randomElement(['Stainless Steel', 'Besi Cor', 'Aluminium', 'Campuran', 'Carbon Steel']),
                'Daya' => fake()->numberBetween(100, 50000) . ' Watt',
            ],
            'price' => fake()->randomFloat(2, 1000000, 500000000),
            'cost_price' => fn(array $attrs) => $attrs['price'] * 0.7,
            'selling_price' => fn(array $attrs) => $attrs['price'],
            'discount_price' => fn(array $attrs) => fake()->boolean(20) ? $attrs['price'] * 0.9 : null,
            'minimum_stock' => fake()->numberBetween(1, 10),
            'maximum_stock' => fn(array $attrs) => $attrs['minimum_stock'] * fake()->numberBetween(5, 20),
            'weight' => fake()->randomFloat(2, 5, 5000),
            'width' => fake()->randomFloat(2, 20, 300),
            'height' => fake()->randomFloat(2, 20, 300),
            'length' => fake()->randomFloat(2, 20, 500),
            'power' => fake()->numberBetween(100, 50000) . ' Watt',
            'capacity' => fake()->numberBetween(1, 10000) . ' ' . fake()->randomElement(['kg/jam', 'liter/jam', 'unit/jam', 'ton/hari']),
            'material' => fake()->randomElement(['Stainless Steel 304', 'Besi Cor', 'Aluminium', 'Carbon Steel', 'Kombinasi']),
            'warranty' => fake()->randomElement(['Garansi 1 Tahun', 'Garansi 2 Tahun', 'Garansi 5 Tahun']),
            'warranty_period' => fake()->randomElement([12, 24, 36, 60]),
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
            'status' => 'active',
            'meta_title' => fn(array $attrs) => 'Jual ' . $attrs['name'] . ' | Harga Murah',
            'meta_description' => fn(array $attrs) => 'Jual ' . $attrs['name'] . ' berkualitas dengan harga terjangkau. Tersedia berbagai kapasitas.',
            'meta_keywords' => fn(array $attrs) => str($attrs['name'])->lower() . ', mesin industri, mesin murah',
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
            'status' => 'inactive',
        ]);
    }
}
