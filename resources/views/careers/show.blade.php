@extends('layouts.app')

@section('title', 'Technical Sales Engineer - Lowongan Karir')
@section('meta_description', 'Lamaran pekerjaan Technical Sales Engineer di Perusahaan Mesin Industri.')

@section('content')
<section class="relative bg-dark py-16">
    <div class="absolute inset-0 bg-gradient-to-r from-dark via-primary to-dark opacity-90"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        @include('partials.breadcrumb', ['items' => [['url' => route('careers.index'), 'label' => 'Karir'], ['label' => 'Technical Sales Engineer']]])
        <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-4">Technical Sales Engineer</h1>
        <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-gray-300">
            <span class="flex items-center space-x-1"><i class="fas fa-building"></i><span>Departemen: Sales</span></span>
            <span class="flex items-center space-x-1"><i class="fas fa-map-marker-alt"></i><span>Lokasi: Jakarta</span></span>
            <span class="flex items-center space-x-1"><i class="fas fa-clock"></i><span>Full-time</span></span>
            <span class="flex items-center space-x-1"><i class="far fa-calendar"></i><span>Deadline: 30 Juli 2026</span></span>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-gray-50 rounded-xl p-6 mb-8">
            <p class="text-gray-600 leading-relaxed">Kami sedang mencari Technical Sales Engineer yang dinamis dan berpengalaman untuk bergabung dengan tim sales kami. Anda akan bertanggung jawab dalam mengembangkan bisnis, membangun hubungan dengan pelanggan, dan memberikan solusi teknis yang tepat.</p>
        </div>

        <div class="space-y-8">
            <div>
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center space-x-2">
                    <i class="fas fa-tasks text-secondary text-sm"></i>
                    <span>Tanggung Jawab</span>
                </h3>
                <ul class="space-y-3">
                    @php
                        $responsibilities = [
                            'Mengembangkan dan mempertahankan hubungan dengan pelanggan existing dan potensial',
                            'Melakukan presentasi produk dan demo teknis kepada calon pelanggan',
                            'Membuat proposal teknis dan penawaran harga',
                            'Berkoordinasi dengan tim teknis untuk solusi pelanggan',
                            'Mencapai target penjualan yang ditetapkan perusahaan',
                            'Melakukan market research dan reporting secara berkala',
                        ];
                    @endphp
                    @foreach($responsibilities as $r)
                    <li class="flex items-start space-x-2 text-gray-600">
                        <i class="fas fa-check-circle text-accent mt-1 text-sm"></i>
                        <span>{{ $r }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center space-x-2">
                    <i class="fas fa-user-graduate text-secondary text-sm"></i>
                    <span>Kualifikasi</span>
                </h3>
                <ul class="space-y-3">
                    @php
                        $qualifications = [
                            'Pendidikan minimal S1 Teknik (Mesin, Industri, Elektro) atau setara',
                            'Pengalaman minimal 2 tahun di bidang sales teknik atau industri',
                            'Memiliki pengetahuan tentang mesin industri dan alat berat',
                            'Kemampuan komunikasi dan negosiasi yang baik',
                            'Bersedia melakukan perjalanan dinas ke berbagai kota',
                            'Menguasai MS Office dan CRM',
                            'Memiliki SIM A dan kendaraan sendiri',
                        ];
                    @endphp
                    @foreach($qualifications as $q)
                    <li class="flex items-start space-x-2 text-gray-600">
                        <i class="fas fa-check-circle text-accent mt-1 text-sm"></i>
                        <span>{{ $q }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center space-x-2">
                    <i class="fas fa-gift text-secondary text-sm"></i>
                    <span>Benefit</span>
                </h3>
                <ul class="space-y-3">
                    @php
                        $benefits = [
                            'Gaji pokok kompetitif + komisi penjualan',
                            'BPJS Ketenagakerjaan & Kesehatan',
                            'Asuransi kesehatan tambahan',
                            'Tunjangan transportasi & komunikasi',
                            'Program pelatihan dan pengembangan',
                            'Jenjang karir yang jelas',
                        ];
                    @endphp
                    @foreach($benefits as $b)
                    <li class="flex items-start space-x-2 text-gray-600">
                        <i class="fas fa-check-circle text-accent mt-1 text-sm"></i>
                        <span>{{ $b }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mt-10 p-8 bg-primary rounded-xl">
            <h3 class="text-xl font-semibold text-white mb-4">Tertarik dengan posisi ini?</h3>
            <p class="text-white/80 mb-6">Kirimkan CV dan surat lamaran Anda ke email karir@perusahaan.com dengan subjek: "Lamaran - Technical Sales Engineer"</p>
            <div class="flex flex-wrap gap-4">
                <a href="mailto:karir@perusahaan.com?subject=Lamaran%20-%20Technical%20Sales%20Engineer" class="inline-flex items-center space-x-2 px-6 py-3 bg-secondary hover:bg-secondary-600 text-white font-semibold rounded-lg transition-all shadow-lg">
                    <i class="far fa-envelope"></i>
                    <span>Lamar via Email</span>
                </a>
                <a href="https://wa.me/6281234567890?text={{ urlencode('Saya ingin melamar posisi Technical Sales Engineer') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition-all">
                    <i class="fab fa-whatsapp"></i>
                    <span>Chat WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
