@extends('back.template.index')
@section('title', 'Detail Data Kalibrasi')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Detail Data Kalibrasi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kalibrasi.index') }}">Kalibrasi</a></li>
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
                        <i class="ri-eye-line me-2"></i>Detail Data Kalibrasi
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Nama Alat</label>
                                <div class="p-3 bg-light rounded">
                                    <h5 class="mb-0 text-primary">{{ $kalibrasi->nama_alat }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Merk Alat</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->merk_alat }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Tipe Alat</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->tipe_alat }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Tanggal Kalibrasi</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-calendar-line me-1"></i>
                                        {{ \Carbon\Carbon::parse($kalibrasi->tanggal_kalibrasi)->format('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary mb-3"><i class="ri-tools-line me-2"></i>Informasi Alat Tambahan</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Merek</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->merek }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Model/Tipe</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->model_tipe }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">No. Seri</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->no_seri }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">No. Order</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->no_order }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary mb-3"><i class="ri-user-3-line me-2"></i>Informasi Pemilik</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Nama Pemilik</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->nama_pemilik }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Nama Ruang</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->nama_ruang }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Alamat Pemilik</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $kalibrasi->alamat_pemilik }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary mb-3"><i class="ri-map-pin-line me-2"></i>Lokasi & Hasil</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Lokasi Kalibrasi</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $kalibrasi->lokasi_kalibrasi }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Hasil Kalibrasi</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $kalibrasi->hasil }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Metode Kerja</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $kalibrasi->metode_kerja }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Dibuat Pada</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-time-line me-1"></i>
                                        {{ $kalibrasi->created_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted">Diupdate Pada</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-refresh-line me-1"></i>
                                        {{ $kalibrasi->updated_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('kalibrasi.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-left-line me-1"></i> Kembali
                                </a>
                                <a href="{{ route('kalibrasi.edit', $kalibrasi->id) }}" class="btn btn-primary">
                                    <i class="ri-edit-line me-1"></i> Edit Data
                                </a>
                                <a href="{{ route('kalibrasi.sertifikat', $kalibrasi->id) }}" target="_blank" class="btn btn-success">
                                    <i class="ri-printer-line me-1"></i> Generate Sertifikat
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
