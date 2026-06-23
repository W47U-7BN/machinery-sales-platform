@extends('vendor.layouts.vendor')
@section('title', 'Dokumen Vendor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Dokumen Vendor</h4>
        <p class="text-muted mb-0">Kelola dokumen dan persyaratan vendor</p>
    </div>
    <button class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="bi bi-upload me-1"></i>Upload Dokumen
    </button>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Dokumen</th>
                        <th class="small">Tipe</th>
                        <th class="small">Ukuran</th>
                        <th class="small">Tanggal Upload</th>
                        <th class="small">Status</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents ?? [] as $doc)
                    <tr>
                        <td class="px-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark-text text-dark me-2 fs-5"></i>
                                <span class="fw-medium small">{{ $doc->name }}</span>
                            </div>
                        </td>
                        <td class="small text-muted">{{ strtoupper($doc->type) }}</td>
                        <td class="small text-muted">{{ $doc->file_size ?? '-' }}</td>
                        <td class="small text-muted">{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td>{!! $doc->status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="{{ Storage::url($doc->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank"><i class="bi bi-eye"></i></a>
                            <a href="{{ Storage::url($doc->file_path) }}" class="btn btn-sm btn-outline-success" download><i class="bi bi-download"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-folder2-open fs-2 d-block mb-2"></i>
                            Belum ada dokumen
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold"><i class="bi bi-upload me-2"></i>Upload Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('vendor.documents.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. SIUP, NPWP, Akta Perusahaan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Tipe Dokumen</label>
                        <select name="type" class="form-select">
                            <option value="legal">Legal / Perizinan</option>
                            <option value="catalog">Katalog Produk</option>
                            <option value="certification">Sertifikasi</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small">File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control" required>
                        <div class="form-text">Format: PDF, JPG, PNG, DOC. Maks: 10MB</div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark rounded-pill"><i class="bi bi-upload me-1"></i>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
