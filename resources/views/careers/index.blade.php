@extends('layouts.app')

@section('title', 'Karir - Bergabung dengan Tim Kami')
@section('meta_description', 'Temukan lowongan pekerjaan terbaru di Perusahaan Mesin Industri. Bergabunglah dengan tim profesional kami.')

@section('content')
<section class="relative bg-dark py-16">
    <div class="absolute inset-0 bg-gradient-to-r from-dark via-primary to-dark opacity-90"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        @include('partials.breadcrumb', ['items' => [['label' => 'Karir']]])
        <h1 class="text-3xl md:text-5xl font-display font-bold text-white mt-4">Karir</h1>
        <p class="text-gray-300 mt-2 max-w-2xl">Bergabunglah dengan tim kami dan berkembang bersama perusahaan mesin industri terkemuka di Indonesia</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-display font-bold text-primary mb-3">Mengapa Bekerja di Perusahaan Mesin?</h2>
            <p class="text-gray-600 max-w-3xl">Kami percaya bahwa karyawan adalah aset terpenting perusahaan. Kami menyediakan lingkungan kerja yang profesional, kesempatan pengembangan karir, dan benefit kompetitif.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            @php
                $benefits = [
                    ['icon' => 'chart-line', 'title' => 'Pengembangan Karir', 'desc' => 'Program pelatihan dan sertifikasi berkelanjutan untuk mengembangkan kompetensi Anda'],
                    ['icon' => 'hand-holding-heart', 'title' => 'Benefit Kompetitif', 'desc' => 'Gaji kompetitif, BPJS, asuransi kesehatan, bonus kinerja, dan tunjangan lainnya'],
                    ['icon' => 'people-arrows', 'title' => 'Lingkungan Dinamis', 'desc' => 'Bekerja dengan tim profesional dalam budaya perusahaan yang inovatif dan kolaboratif'],
                ];
            @endphp
            @foreach($benefits as $b)
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm text-center hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-primary/5 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-{{ $b['icon'] }} text-secondary text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">{{ $b['title'] }}</h3>
                <p class="text-sm text-gray-500">{{ $b['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-display font-bold text-primary">Lowongan Tersedia</h2>
            </div>
            @php
                $jobs = [
                    ['title' => 'Technical Sales Engineer', 'dept' => 'Sales', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '30 Jul 2026'],
                    ['title' => 'Service Technician', 'dept' => 'Technical', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '15 Agt 2026'],
                    ['title' => 'Digital Marketing Specialist', 'dept' => 'Marketing', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '20 Agt 2026'],
                    ['title' => 'Warehouse Supervisor', 'dept' => 'Logistik', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '10 Agt 2026'],
                    ['title' => 'Finance & Accounting Staff', 'dept' => 'Finance', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '25 Jul 2026'],
                    ['title' => 'Customer Service Representative', 'dept' => 'CS', 'loc' => 'Jakarta', 'type' => 'Full-time', 'deadline' => '5 Agt 2026'],
                ];
            @endphp
            @foreach($jobs as $job)
            <a href="{{ route('careers.show', Str::slug($job['title'])) }}" class="block p-6 border-b border-gray-50 hover:bg-gray-50 transition-all group">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-primary transition-colors">{{ $job['title'] }}</h3>
                        <div class="flex flex-wrap items-center gap-3 mt-2 text-xs text-gray-500">
                            <span class="flex items-center space-x-1"><i class="fas fa-building"></i><span>{{ $job['dept'] }}</span></span>
                            <span class="flex items-center space-x-1"><i class="fas fa-map-marker-alt"></i><span>{{ $job['loc'] }}</span></span>
                            <span class="flex items-center space-x-1"><i class="fas fa-clock"></i><span>{{ $job['type'] }}</span></span>
                            <span class="flex items-center space-x-1"><i class="far fa-calendar"></i><span>Deadline: {{ $job['deadline'] }}</span></span>
                        </div>
                    </div>
                    <span class="inline-flex items-center space-x-1 text-sm font-medium text-secondary group-hover:translate-x-1 transition-transform">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
