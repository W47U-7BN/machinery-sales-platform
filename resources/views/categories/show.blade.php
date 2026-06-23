@extends('layouts.app')

@section('title', 'Mesin Konstruksi - Kategori Produk')
@section('meta_description', 'Koleksi lengkap mesin konstruksi dan alat berat untuk proyek Anda. Excavator, Bulldozer, Crane, dan banyak lagi.')

@section('content')
<section class="relative bg-dark py-16">
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-dark to-primary opacity-90"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        @include('partials.breadcrumb', ['items' => [['url' => route('products.index'), 'label' => 'Produk'], ['label' => 'Mesin Konstruksi']]])
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mt-6">
            <div>
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Kategori</span>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-white mt-2">Mesin Konstruksi</h1>
                <p class="text-gray-300 mt-3 leading-relaxed">Koleksi lengkap mesin konstruksi dan alat berat untuk mendukung proyek infrastruktur Anda. Dari excavator hingga bulldozer, semua tersedia dengan kualitas terbaik.</p>
            </div>
            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600" alt="Mesin Konstruksi" class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Subkategori</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @php
                $subs = ['Excavator', 'Bulldozer', 'Crane', 'Forklift', 'Compactor', 'Motor Grader', 'Wheel Loader', 'Dump Truck', 'Backhoe Loader', 'Skid Steer', 'Asphalt Paver', 'Road Roller'];
            @endphp
            @foreach($subs as $sub)
            <a href="#" class="px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-center text-sm font-medium text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-all">{{ $sub }}</a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <p class="text-sm text-gray-500">Menampilkan <span class="font-semibold text-gray-800">12</span> produk</p>
            <select class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20">
                <option>Terbaru</option>
                <option>Harga: Rendah ke Tinggi</option>
                <option>Harga: Tinggi ke Rendah</option>
            </select>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $products = [
                    ['name' => 'Excavator EC480D', 'category' => 'Excavator', 'badge' => 'Best Seller'],
                    ['name' => 'Bulldozer D6R2', 'category' => 'Bulldozer', 'badge' => 'Promo'],
                    ['name' => 'Motor Grader 140M', 'category' => 'Motor Grader', 'badge' => ''],
                    ['name' => 'Wheel Loader WA380', 'category' => 'Wheel Loader', 'badge' => ''],
                    ['name' => 'Compactor CS76', 'category' => 'Compactor', 'badge' => 'Sale'],
                    ['name' => 'Dump Truck HD785', 'category' => 'Dump Truck', 'badge' => ''],
                    ['name' => 'Crane SR530', 'category' => 'Crane', 'badge' => 'New'],
                    ['name' => 'Forklift FD50', 'category' => 'Forklift', 'badge' => ''],
                ];
            @endphp
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endsection
