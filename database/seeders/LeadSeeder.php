<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $customerIds = Customer::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
        $salesIds = User::role('Sales')->pluck('id')->toArray();

        if (empty($salesIds)) {
            $salesIds = User::pluck('id')->toArray();
        }

        $leads = [
            ['name' => 'Budi Santoso', 'company' => 'PT Makanan Sehat', 'source' => 'Website', 'status' => 'new', 'priority' => 'high', 'title' => 'Pengadaan Mesin Penggiling Kopi', 'estimated_value' => 35000000],
            ['name' => 'Siti Rahmawati', 'company' => 'CV Minuman Segar', 'source' => 'WhatsApp', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Mesin Filling Minuman', 'estimated_value' => 125000000],
            ['name' => 'Ahmad Fauzi', 'company' => 'UD Pakan Ikan', 'source' => 'Telepon', 'status' => 'proposal', 'priority' => 'high', 'title' => 'Mesin Pelet Apung 500kg/jam', 'estimated_value' => 45000000],
            ['name' => 'Dewi Sartika', 'company' => 'PT Farmasi Sehat', 'source' => 'Email', 'status' => 'negotiation', 'priority' => 'high', 'title' => 'Tablet Press 16 Punch', 'estimated_value' => 185000000],
            ['name' => 'Hendra Gunawan', 'company' => 'CV Teknik Utama', 'source' => 'Referensi', 'status' => 'new', 'priority' => 'low', 'title' => 'Conveyor Belt 10m', 'estimated_value' => 65000000],
            ['name' => 'Rina Wijaya', 'company' => 'PT Kemasan Indah', 'source' => 'Media Sosial', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'VFFS Packaging Machine', 'estimated_value' => 85000000],
            ['name' => 'Agus Prasetyo', 'company' => 'CV Roti Bakery', 'source' => 'Pameran', 'status' => 'proposal', 'priority' => 'medium', 'title' => 'Mixer Spiral 50kg', 'estimated_value' => 12500000],
            ['name' => 'Fitri Handayani', 'company' => 'PT Es Kristal', 'source' => 'Google Ads', 'status' => 'new', 'priority' => 'high', 'title' => 'Mesin Es Kristal 5 Ton', 'estimated_value' => 450000000],
            ['name' => 'Doni Pratama', 'company' => 'UD Ternak Ayam', 'source' => 'Kunjungan Lapangan', 'status' => 'lost', 'priority' => 'low', 'title' => 'Kandang Baterai Ayam', 'estimated_value' => 25000000],
            ['name' => 'Yuni Astuti', 'company' => 'PT Susu Murni', 'source' => 'Website', 'status' => 'qualified', 'priority' => 'high', 'title' => 'Pasteurisasi Susu 500L/jam', 'estimated_value' => 95000000],
            ['name' => 'Rudi Hartono', 'company' => 'CV Aneka Snack', 'source' => 'WhatsApp', 'status' => 'new', 'priority' => 'medium', 'title' => 'Extruder Makanan Ringan', 'estimated_value' => 35000000],
            ['name' => 'Mega Putri', 'company' => 'PT Air Minum', 'source' => 'Marketplace', 'status' => 'negotiation', 'priority' => 'high', 'title' => 'Mesin RO Industri', 'estimated_value' => 165000000],
            ['name' => 'Adi Nugroho', 'company' => 'CV Bangunan Jaya', 'source' => 'Telepon', 'status' => 'new', 'priority' => 'low', 'title' => 'Generator 50 KVA', 'estimated_value' => 95000000],
            ['name' => 'Widi Astuti', 'company' => 'PT Pupuk Nusantara', 'source' => 'Email', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Conveyor Screw 6m', 'estimated_value' => 45000000],
            ['name' => 'Bayu Permadi', 'company' => 'UD Ikan Lele', 'source' => 'Referensi', 'status' => 'new', 'priority' => 'low', 'title' => 'Pompa Air Tambak', 'estimated_value' => 5500000],
            ['name' => 'Sari Dewi', 'company' => 'PT Jamu Herbal', 'source' => 'Media Sosial', 'status' => 'proposal', 'priority' => 'medium', 'title' => 'Mesin Pengisi Kapsul', 'estimated_value' => 45000000],
            ['name' => 'Irfan Hakim', 'company' => 'CV Plastik Kemasan', 'source' => 'Google Ads', 'status' => 'won', 'priority' => 'medium', 'title' => 'Mesin Shrink Wrap', 'estimated_value' => 12500000],
            ['name' => 'Lina Marlina', 'company' => 'PT Tahu Tempe', 'source' => 'Kunjungan Lapangan', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Mesin Penggiling Kedelai', 'estimated_value' => 8500000],
            ['name' => 'Taufik Hidayat', 'company' => 'CV Karet Industri', 'source' => 'Website', 'status' => 'new', 'priority' => 'low', 'title' => 'Boiler 2 Ton', 'estimated_value' => 450000000],
            ['name' => 'Desi Ratnasari', 'company' => 'PT Minyak Goreng', 'source' => 'WhatsApp', 'status' => 'negotiation', 'priority' => 'high', 'title' => 'Thermic Oil Heater', 'estimated_value' => 325000000],
            ['name' => 'Eko Prasetyo', 'company' => 'UD Ternak Kambing', 'source' => 'Telepon', 'status' => 'lost', 'priority' => 'low', 'title' => 'Mesin Pencacah Rumput', 'estimated_value' => 4500000],
            ['name' => 'Nina Septiani', 'company' => 'PT Roti Indo', 'source' => 'Email', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Oven Roti 3 Deck', 'estimated_value' => 28000000],
            ['name' => 'Cahyadi Putra', 'company' => 'CV Furniture Jati', 'source' => 'Referensi', 'status' => 'new', 'priority' => 'low', 'title' => 'Mesin Profil Kayu', 'estimated_value' => 18500000],
            ['name' => 'Rika Amelia', 'company' => 'PT Kosmetik Natural', 'source' => 'Media Sosial', 'status' => 'proposal', 'priority' => 'medium', 'title' => 'Mixer V-Type Farmasi', 'estimated_value' => 75000000],
            ['name' => 'Fajar Sidik', 'company' => 'CV Es Batu', 'source' => 'Google Ads', 'status' => 'new', 'priority' => 'high', 'title' => 'Mesin Es Tube 1 Ton', 'estimated_value' => 185000000],
            ['name' => 'Indah Permatasari', 'company' => 'PT Kue Kering', 'source' => 'Marketplace', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Mesin Packaging Snack', 'estimated_value' => 55000000],
            ['name' => 'Gunawan Saputra', 'company' => 'CV Logam Jaya', 'source' => 'Kunjungan Lapangan', 'status' => 'negotiation', 'priority' => 'high', 'title' => 'Mesin Las Industri', 'estimated_value' => 35000000],
            ['name' => 'Ratna Dewi', 'company' => 'PT Peternakan Ayam', 'source' => 'Website', 'status' => 'new', 'priority' => 'medium', 'title' => 'Mesin Pakan Ternak', 'estimated_value' => 25000000],
            ['name' => 'Herman Susanto', 'company' => 'UD Beras Organik', 'source' => 'WhatsApp', 'status' => 'qualified', 'priority' => 'medium', 'title' => 'Mesin Pengering Gabah', 'estimated_value' => 55000000],
            ['name' => 'Vivi Nuraini', 'company' => 'PT Sari Buah', 'source' => 'Telepon', 'status' => 'new', 'priority' => 'low', 'title' => 'Mesin Pasteurisasi Jus', 'estimated_value' => 125000000],
        ];

        foreach ($leads as $data) {
            Lead::create([
                'customer_id' => fake()->randomElement($customerIds),
                'product_id' => !empty($productIds) ? fake()->randomElement($productIds) : null,
                'assigned_to' => !empty($salesIds) ? fake()->randomElement($salesIds) : null,
                'name' => $data['name'],
                'email' => strtolower(str_replace(' ', '.', $data['name'])) . '@email.com',
                'phone' => fake()->numerify('08##########'),
                'company' => $data['company'],
                'source' => $data['source'],
                'status' => $data['status'],
                'priority' => $data['priority'],
                'title' => $data['title'],
                'estimated_value' => $data['estimated_value'],
                'notes' => $data['status'] === 'lost' ? fake()->randomElement(['Harga terlalu mahal', 'Memilih kompetitor', 'Proyek ditunda']) : null,
                'expected_close_date' => in_array($data['status'], ['new', 'qualified', 'proposal', 'negotiation']) ? now()->addMonths(fake()->numberBetween(1, 6)) : null,
                'converted_at' => $data['status'] === 'won' ? now() : null,
            ]);
        }
    }
}
