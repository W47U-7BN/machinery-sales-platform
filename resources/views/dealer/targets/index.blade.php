@extends('dealer.layouts.dealer')
@section('title', 'Target Penjualan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Target Penjualan</h4>
        <p class="text-muted mb-0">Progress pencapaian target Anda</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-bullseye me-2 text-warning"></i>Target Saat Ini</h6>
                @if($currentTarget ?? false)
                <div class="d-flex justify-content-between mb-2">
                    <span class="small">Periode: {{ $currentTarget->period ?? 'Bulan Ini' }}</span>
                    <span class="small">{{ $currentTarget->progress ?? 0 }}%</span>
                </div>
                <div class="progress mb-3" style="height: 30px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ ($currentTarget->progress ?? 0) >= 100 ? 'success' : 'warning' }}" role="progressbar" style="width: {{ min($currentTarget->progress ?? 0, 100) }}%;">
                        Rp {{ number_format($currentTarget->achieved ?? 0, 0, ',', '.') }} / Rp {{ number_format($currentTarget->amount ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        <p class="text-muted small mb-0">Target</p>
                        <p class="fw-bold mb-0">Rp {{ number_format($currentTarget->amount ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-4">
                        <p class="text-muted small mb-0">Tercapai</p>
                        <p class="fw-bold mb-0 text-success">Rp {{ number_format($currentTarget->achieved ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-4">
                        <p class="text-muted small mb-0">Sisa</p>
                        <p class="fw-bold mb-0 text-danger">Rp {{ number_format(max(($currentTarget->amount ?? 0) - ($currentTarget->achieved ?? 0), 0), 0, ',', '.') }}</p>
                    </div>
                </div>
                @else
                <p class="text-muted small text-center py-3">Tidak ada target untuk periode ini</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-3 px-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Target</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Periode</th>
                        <th class="small">Target</th>
                        <th class="small">Tercapai</th>
                        <th class="small">Progress</th>
                        <th class="small">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($targets ?? [] as $target)
                    <tr>
                        <td class="px-3 small">{{ $target->period }}</td>
                        <td class="fw-medium">Rp {{ number_format($target->amount, 0, ',', '.') }}</td>
                        <td class="fw-medium">Rp {{ number_format($target->achieved, 0, ',', '.') }}</td>
                        <td>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-{{ $target->progress >= 100 ? 'success' : 'warning' }}" style="width: {{ min($target->progress, 100) }}%;"></div>
                            </div>
                            <span class="small text-muted">{{ $target->progress }}%</span>
                        </td>
                        <td>{!! $target->status_badge !!}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-bullseye fs-2 d-block mb-2"></i>
                            Belum ada data target
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
