@extends('dealer.layouts.dealer')
@section('title', 'Profil Dealer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Profil Dealer</h4>
        <p class="text-muted mb-0">Kelola informasi akun dealer Anda</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
            <div class="card-body py-4">
                <div class="mb-3">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="bi bi-shop text-success fs-1"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ Auth::user()->name ?? 'Dealer' }}</h5>
                <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
                <p class="text-muted small">{{ Auth::user()->dealer_code ?? 'DLR-001' }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil me-2 text-success"></i>Edit Profil</h6>
            </div>
            <div class="card-body px-3">
                <form method="POST" action="{{ route('dealer.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Nama Perusahaan</label>
                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', Auth::user()->company_name ?? '') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Alamat</label>
                            <textarea name="address" rows="2" class="form-control">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Kota</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', Auth::user()->city ?? '') }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success rounded-pill px-4"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
