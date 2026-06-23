@extends('layouts.admin')

@section('title', 'Create Campaign')
@section('page-title', 'Buat Campaign Baru')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Marketing</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
<li class="breadcrumb-item active">Buat Baru</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.campaigns.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>Informasi Campaign</h6></div>
    <div class="card-body">
        <form>
            <div class="row g-3">
                <div class="col-md-8"><label class="form-label">Campaign Name <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
                <div class="col-md-4"><label class="form-label">Status</label><select class="form-select"><option>Draft</option><option>Active</option><option>Scheduled</option></select></div>
                <div class="col-md-4"><label class="form-label">Type</label><select class="form-select"><option>Email</option><option>Social Media</option><option>Event</option><option>PPC</option><option>Content</option></select></div>
                <div class="col-md-4"><label class="form-label">Start Date</label><input type="date" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">End Date</label><input type="date" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Budget</label><div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control"></div></div>
                <div class="col-md-6"><label class="form-label">Target Audience</label><input type="text" class="form-control" placeholder="e.g. Construction companies"></div>
                <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" rows="3"></textarea></div>
                <div class="col-12"><label class="form-label">Goals / Objectives</label><textarea class="form-control" rows="3" placeholder="e.g. Generate 100 leads, increase brand awareness"></textarea></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-admin-light">Cancel</a>
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i> Simpan Campaign</button>
            </div>
        </form>
    </div>
</div>
@endsection
