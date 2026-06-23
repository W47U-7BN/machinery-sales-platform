@extends('dealer.layouts.dealer')
@section('title', 'Download Marketing')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Download Marketing</h4>
        <p class="text-muted mb-0">Katalog dan materi pemasaran untuk dealer</p>
    </div>
</div>

<div class="row g-3">
    @forelse($documents ?? [] as $doc)
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    @if(str_contains($doc->type ?? '', 'pdf'))
                    <i class="bi bi-file-earmark-pdf text-danger fs-1"></i>
                    @elseif(str_contains($doc->type ?? '', 'image'))
                    <i class="bi bi-file-earmark-image text-primary fs-1"></i>
                    @else
                    <i class="bi bi-file-earmark text-secondary fs-1"></i>
                    @endif
                </div>
                <h6 class="fw-bold small mb-1">{{ $doc->name }}</h6>
                <p class="text-muted small mb-2">{{ $doc->description ?? $doc->file_size ?? '' }}</p>
                <a href="{{ Storage::url($doc->file_path) }}" class="btn btn-sm btn-success rounded-pill w-100" download>
                    <i class="bi bi-download me-1"></i>Download
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                Belum ada materi marketing tersedia
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
