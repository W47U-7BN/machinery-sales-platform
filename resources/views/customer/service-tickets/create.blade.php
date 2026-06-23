@extends('customer.layouts.customer')
@section('title', 'Buat Tiket Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Buat Tiket Service Baru</h4>
        <p class="text-muted mb-0">Laporkan masalah atau permintaan service</p>
    </div>
    <a href="{{ route('customer.service-tickets.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('customer.service-tickets.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Subjek <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="e.g. Mesin tidak berfungsi" required>
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small">Prioritas <span class="text-danger">*</span></label>
                            <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small">Kategori</label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="kerusakan" {{ old('category') == 'kerusakan' ? 'selected' : '' }}>Kerusakan Mesin</option>
                                <option value="perawatan" {{ old('category') == 'perawatan' ? 'selected' : '' }}>Perawatan Rutin</option>
                                <option value="instalasi" {{ old('category') == 'instalasi' ? 'selected' : '' }}>Instalasi</option>
                                <option value="konsultasi" {{ old('category') == 'konsultasi' ? 'selected' : '' }}>Konsultasi Teknis</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium small">Produk Terkait</label>
                        <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                            <option value="">Pilih Produk (opsional)</option>
                            @foreach($products ?? [] as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium small">Deskripsi Masalah <span class="text-danger">*</span></label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Jelaskan masalah yang Anda alami secara detail..." required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium small">Lampiran (foto/dokumen)</label>
                        <input type="file" name="attachments[]" class="form-control @error('attachments.*') is-invalid @enderror" multiple accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text">Maksimal 5 file, masing-masing 10MB. Format: JPG, PNG, PDF</div>
                        @error('attachments.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('customer.service-tickets.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-send me-1"></i>Kirim Tiket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
