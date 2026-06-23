@extends('layouts.admin')

@section('title', 'Campaigns')
@section('page-title', 'Campaigns Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Marketing</a></li>
<li class="breadcrumb-item active">Campaigns</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.campaigns.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> New Campaign</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Campaigns</h6></div>
    <div class="card-body">
        <div class="row g-4">
            @foreach(range(1,6) as $i)
            <div class="col-md-6 col-xl-4">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge-status bg-{{ ['completed','in-progress','pending','completed','in-progress','draft'][$i-1] }}">{{ ['Completed','Active','Scheduled','Completed','Active','Draft'][$i-1] }}</span>
                        <small class="text-muted">{{ date('d/m/Y', strtotime('-'.$i*5.' days')) }}</small>
                    </div>
                    <h6 class="fw-bold mb-1">Campaign {{ $i }} - {{ ['Q2 Product Launch','Email Series','Trade Show Q3','Newsletter','Social Media','Retargeting'][$i-1] }}</h6>
                    <p class="small text-muted mb-3">{{ ['Launching new excavator series','Weekly email to 5k leads','Exhibition at Mining Expo 2026','Monthly newsletter June','Instagram & LinkedIn ads','Google Ads retargeting'][$i-1] }}</p>
                    <div class="d-flex justify-content-between small"><span class="text-muted">Budget</span><span>Rp {{ number_format(rand(5000000,50000000),0,',','.') }}</span></div>
                    <div class="d-flex justify-content-between small"><span class="text-muted">Leads Generated</span><span class="fw-semibold">{{ rand(10,500) }}</span></div>
                    <div class="d-flex justify-content-between small mb-2"><span class="text-muted">Conversion</span><span class="fw-semibold text-success">{{ rand(2,20) }}%</span></div>
                    <div class="d-flex gap-2 mt-2">
                        <a href="#" class="btn btn-sm btn-admin-outline flex-grow-1"><i class="bi bi-eye"></i> View</a>
                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
