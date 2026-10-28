@extends('back.template.index')
@section('title', 'Detail Laporan Maintenance')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Detail Laporan Maintenance</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laporan-maintenance.index') }}">Laporan Maintenance</a></li>
                        <li class="breadcrumb-item active">Detail Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="ri-file-list-3-line me-2"></i>Detail Laporan Maintenance
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Informasi Alat -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-tools-line me-2"></i>Informasi Alat
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Nama Alat</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0 text-primary">{{ $laporanMaintenance->nama_alat }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Merk</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $laporanMaintenance->merk }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Nomor Seri</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $laporanMaintenance->no_seri }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Teknisi</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-user-line me-1"></i>{{ $laporanMaintenance->teknisi }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Maintenance -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-calendar-line me-2"></i>Jadwal Maintenance
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tanggal Maintenance</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-calendar-check-line me-1"></i>
                                        {{ \Carbon\Carbon::parse($laporanMaintenance->tgl_maintenance)->format('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Maintenance -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-settings-3-line me-2"></i>Detail Maintenance
                            </h5>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tindakan yang Dilakukan</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $laporanMaintenance->tindakan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Hasil Maintenance</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $laporanMaintenance->hasil }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timestamp -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Dibuat Pada</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-time-line me-1"></i>
                                        {{ $laporanMaintenance->created_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Diupdate Pada</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-refresh-line me-1"></i>
                                        {{ $laporanMaintenance->updated_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('laporan-maintenance.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-left-line me-1"></i> Kembali
                                </a>
                                <a href="{{ route('laporan-maintenance.edit', $laporanMaintenance->id) }}" class="btn btn-primary">
                                    <i class="ri-edit-line me-1"></i> Edit Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection