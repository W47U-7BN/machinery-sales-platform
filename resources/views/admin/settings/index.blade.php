@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Pengaturan Sistem')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<ul class="nav nav-tabs tab-nav-custom" id="settingsTabs" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#s-general">Umum</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-company">Perusahaan</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-email">Email</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-social">Sosial Media</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-seo">SEO</button></li>
</ul>

<div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="s-general">
        <div class="admin-card">
            <div class="card-header"><h6>Pengaturan Umum</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Nama Aplikasi</label><input type="text" class="form-control" value="MachineryERP"></div>
                        <div class="col-md-6"><label class="form-label">URL Website</label><input type="url" class="form-control" value="https://perusahaanmesin.com"></div>
                        <div class="col-md-4"><label class="form-label">Timezone</label><select class="form-select"><option selected>Asia/Jakarta</option><option>Asia/Makassar</option></select></div>
                        <div class="col-md-4"><label class="form-label">Locale</label><select class="form-select"><option selected>id</option><option>en</option></select></div>
                        <div class="col-md-4"><label class="form-label">Currency</label><select class="form-select"><option selected>IDR</option><option>USD</option></select></div>
                        <div class="col-12"><label class="form-label">Maintenance Mode</label><select class="form-select"><option>Disabled</option><option>Enabled</option></select></div>
                    </div>
                    <div class="d-flex justify-content-end mt-4"><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="s-company">
        <div class="admin-card">
            <div class="card-header"><h6>Informasi Perusahaan</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Nama Perusahaan</label><input type="text" class="form-control" value="PT Perusahaan Mesin Industri"></div>
                        <div class="col-md-6"><label class="form-label">Tagline</label><input type="text" class="form-control" value="Solusi Mesin Industri Terpercaya"></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" value="info@perusahaanmesin.com"></div>
                        <div class="col-md-6"><label class="form-label">No. Telepon</label><input type="text" class="form-control" value="(021) 1234-5678"></div>
                        <div class="col-md-6"><label class="form-label">WhatsApp</label><input type="text" class="form-control" value="+62 812-3456-7890"></div>
                        <div class="col-md-6"><label class="form-label">NPWP</label><input type="text" class="form-control" value="01.234.567.8-999.000"></div>
                        <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2">Jl. Industri Raya No. 123, Kelapa Gading, Jakarta Utara 14240</textarea></div>
                        <div class="col-12"><label class="form-label">Company Logo</label><div class="image-upload-wrapper" style="padding:20px;max-width:300px;"><i class="bi bi-building upload-icon"></i><div class="upload-text small">Upload logo</div></div></div>
                    </div>
                    <div class="d-flex justify-content-end mt-4"><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="s-email">
        <div class="admin-card">
            <div class="card-header"><h6>Pengaturan Email</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Mail Driver</label><select class="form-select"><option selected>smtp</option><option>sendmail</option></select></div>
                        <div class="col-md-6"><label class="form-label">Mail Host</label><input type="text" class="form-control" value="smtp.gmail.com"></div>
                        <div class="col-md-4"><label class="form-label">Port</label><input type="text" class="form-control" value="587"></div>
                        <div class="col-md-4"><label class="form-label">Username</label><input type="text" class="form-control" value="noreply@perusahaanmesin.com"></div>
                        <div class="col-md-4"><label class="form-label">Encryption</label><select class="form-select"><option selected>tls</option><option>ssl</option></select></div>
                        <div class="col-12"><label class="form-label">From Address</label><input type="email" class="form-control" value="noreply@perusahaanmesin.com"></div>
                        <div class="col-12"><label class="form-label">From Name</label><input type="text" class="form-control" value="Perusahaan Mesin Industri"></div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4"><button type="submit" class="btn btn-admin-primary">Simpan</button><button type="button" class="btn btn-admin-accent">Test Email</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="s-social">
        <div class="admin-card">
            <div class="card-header"><h6>Sosial Media Links</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-facebook me-1 text-primary"></i> Facebook</label><input type="url" class="form-control" value="https://facebook.com/perusahaanmesin"></div>
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-instagram me-1 text-danger"></i> Instagram</label><input type="url" class="form-control" value="https://instagram.com/perusahaanmesin"></div>
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-linkedin me-1 text-primary"></i> LinkedIn</label><input type="url" class="form-control" value="https://linkedin.com/company/perusahaanmesin"></div>
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-youtube me-1 text-danger"></i> YouTube</label><input type="url" class="form-control" value="https://youtube.com/@perusahaanmesin"></div>
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-tiktok me-1"></i> TikTok</label><input type="url" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label"><i class="fab fa-twitter me-1"></i> Twitter</label><input type="url" class="form-control"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-4"><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="s-seo">
        <div class="admin-card">
            <div class="card-header"><h6>SEO Settings</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Meta Title</label><input type="text" class="form-control" value="Perusahaan Mesin Industri - Solusi Mesin Industri Terpercaya"></div>
                        <div class="col-12"><label class="form-label">Meta Description</label><textarea class="form-control" rows="2">Perusahaan penyedia mesin industri dan alat berat terpercaya di Indonesia. Distributor resmi dengan 15+ tahun pengalaman.</textarea></div>
                        <div class="col-12"><label class="form-label">Meta Keywords</label><input type="text" class="form-control" value="mesin industri, alat berat, konstruksi, pertambangan, manufaktur, Indonesia"></div>
                        <div class="col-12"><label class="form-label">Google Analytics ID</label><input type="text" class="form-control" placeholder="G-XXXXXXXXXX"></div>
                        <div class="col-12"><label class="form-label">Facebook Pixel ID</label><input type="text" class="form-control" placeholder="XXXXXXXXXXXXXXX"></div>
                    </div>
                    <div class="d-flex justify-content-end mt-4"><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
