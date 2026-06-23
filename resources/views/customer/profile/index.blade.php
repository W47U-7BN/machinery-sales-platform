@extends('customer.layouts.customer')
@section('title', 'Profil Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Profil Saya</h4>
        <p class="text-muted mb-0">Kelola informasi akun Anda</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
            <div class="card-body py-4">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="bi bi-person-circle text-primary fs-1"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ Auth::user()->name ?? 'Customer' }}</h5>
                <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil me-2 text-primary"></i>Edit Profil</h6>
            </div>
            <div class="card-body px-3">
                <form method="POST" action="{{ route('customer.profile.update') }}">
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
                            <label class="form-label small">Perusahaan</label>
                            <input type="text" name="company" class="form-control" value="{{ old('company', Auth::user()->company ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Alamat</label>
                        <textarea name="address" rows="2" class="form-control">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mt-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-lock me-2 text-warning"></i>Ubah Password</h6>
            </div>
            <div class="card-body px-3">
                <form method="POST" action="{{ route('customer.profile.password') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label small">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning rounded-pill px-4"><i class="bi bi-check-lg me-1"></i>Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
