@extends('back.template.index')
@section('title', 'Edit Laporan Maintenance')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Laporan Maintenance</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laporan-maintenance.index') }}">Laporan Maintenance</a></li>
                        <li class="breadcrumb-item active">Edit Data</li>
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
                        <i class="ri-edit-line me-2"></i>Form Edit Laporan Maintenance
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ri-error-warning-line me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('laporan-maintenance.update', $laporanMaintenance->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Informasi Alat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-tools-line me-2"></i>Informasi Alat
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_alat" class="form-label">
                                        Nama Alat <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                                           id="nama_alat" name="nama_alat" 
                                           value="{{ old('nama_alat', $laporanMaintenance->nama_alat) }}" 
                                           placeholder="Masukkan nama alat" required>
                                    @error('nama_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="merk" class="form-label">
                                        Merk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror" 
                                           id="merk" name="merk" 
                                           value="{{ old('merk', $laporanMaintenance->merk) }}" 
                                           placeholder="Masukkan merk alat" required>
                                    @error('merk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_seri" class="form-label">
                                        Nomor Seri <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('no_seri') is-invalid @enderror" 
                                           id="no_seri" name="no_seri" 
                                           value="{{ old('no_seri', $laporanMaintenance->no_seri) }}" 
                                           placeholder="Masukkan nomor seri" required>
                                    @error('no_seri')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teknisi" class="form-label">
                                        Teknisi <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('teknisi') is-invalid @enderror" 
                                           id="teknisi" name="teknisi" 
                                           value="{{ old('teknisi', $laporanMaintenance->teknisi) }}" 
                                           placeholder="Masukkan nama teknisi" required>
                                    @error('teknisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Maintenance -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-calendar-line me-2"></i>Jadwal Maintenance
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_maintenance" class="form-label">
                                        Tanggal Maintenance <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('tgl_maintenance') is-invalid @enderror" 
                                           id="tgl_maintenance" name="tgl_maintenance" 
                                           value="{{ old('tgl_maintenance', $laporanMaintenance->tgl_maintenance) }}" required>
                                    @error('tgl_maintenance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <label for="tindakan" class="form-label">
                                        Tindakan yang Dilakukan <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('tindakan') is-invalid @enderror" 
                                              id="tindakan" name="tindakan" rows="3" 
                                              placeholder="Masukkan tindakan yang dilakukan" required>{{ old('tindakan', $laporanMaintenance->tindakan) }}</textarea>
                                    @error('tindakan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="hasil" class="form-label">
                                        Hasil Maintenance <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('hasil') is-invalid @enderror" 
                                              id="hasil" name="hasil" rows="3" 
                                              placeholder="Masukkan hasil maintenance" required>{{ old('hasil', $laporanMaintenance->hasil) }}</textarea>
                                    @error('hasil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush