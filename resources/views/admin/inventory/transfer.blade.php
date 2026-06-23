@extends('layouts.admin')

@section('title', 'Stock Transfer')
@section('page-title', 'Transfer Stok Antar Warehouse')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.inventory.index') }}">Inventori</a></li>
<li class="breadcrumb-item active">Transfer Stok</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.inventory.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Transfer Details</h6></div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">From Warehouse <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Pilih warehouse asal</option>
                                <option>Warehouse Utama - Jakarta</option>
                                <option>Warehouse Surabaya</option>
                                <option>Warehouse Bandung</option>
                                <option>Warehouse Medan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Warehouse <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Pilih warehouse tujuan</option>
                                <option>Warehouse Utama - Jakarta</option>
                                <option>Warehouse Surabaya</option>
                                <option>Warehouse Bandung</option>
                                <option>Warehouse Medan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Product <span class="text-danger">*</span></label>
                            <select class="form-select select2" required>
                                <option value="">Cari product...</option>
                                <option>Excavator EC220D</option>
                                <option>Bulldozer D6R</option>
                                <option>Crane RT100</option>
                                <option>Conveyor Belt 1200</option>
                                <option>Hydraulic Press 500T</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Available Stock</label>
                            <input type="text" class="form-control" value="12 Units" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Reason for transfer, reference number, etc."></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.inventory.index') }}" class="btn btn-admin-light">Cancel</a>
                        <button type="submit" class="btn btn-admin-primary"><i class="bi bi-arrow-left-right me-1"></i> Proses Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Recent Transfers</h6></div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach(range(1,5) as $i)
                    <div class="list-group-item list-group-item-action py-3">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</small>
                            <span class="badge-status bg-completed">Completed</span>
                        </div>
                        <div class="fw-medium small">Warehouse Utama → Surabaya</div>
                        <small class="text-muted">Excavator EC220D (2 units)</small>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('admin.inventory.movements') }}" class="text-decoration-none small">View All Movements</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('.select2').select2({placeholder:'Cari product...',allowClear:true});});</script>
@endpush
