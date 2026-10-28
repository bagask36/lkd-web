@extends('back.template.index')
@section('title', 'Tambah Data Kalibrasi')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tambah Data Kalibrasi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kalibrasi.index') }}">Kalibrasi</a></li>
                        <li class="breadcrumb-item active">Tambah Data</li>
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
                        <i class="ri-tools-line me-2"></i>Form Tambah Data Kalibrasi
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

                    <form action="{{ route('kalibrasi.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_alat" class="form-label">
                                        Nama Alat <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                                           id="nama_alat" name="nama_alat" 
                                           value="{{ old('nama_alat') }}" 
                                           placeholder="Masukkan nama alat" required>
                                    @error('nama_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="merk_alat" class="form-label">
                                        Merk Alat <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('merk_alat') is-invalid @enderror" 
                                           id="merk_alat" name="merk_alat" 
                                           value="{{ old('merk_alat') }}" 
                                           placeholder="Masukkan merk alat" required>
                                    @error('merk_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tipe_alat" class="form-label">
                                        Tipe Alat <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('tipe_alat') is-invalid @enderror" 
                                           id="tipe_alat" name="tipe_alat" 
                                           value="{{ old('tipe_alat') }}" 
                                           placeholder="Masukkan tipe alat" required>
                                    @error('tipe_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_kalibrasi" class="form-label">
                                        Tanggal Kalibrasi <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('tanggal_kalibrasi') is-invalid @enderror" 
                                           id="tanggal_kalibrasi" name="tanggal_kalibrasi" 
                                           value="{{ old('tanggal_kalibrasi') }}" required>
                                    @error('tanggal_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3"><i class="ri-tools-line me-2"></i>Informasi Alat Tambahan</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="model_tipe" class="form-label">Model/Tipe</label>
                                    <input type="text" class="form-control @error('model_tipe') is-invalid @enderror" id="model_tipe" name="model_tipe" value="{{ old('model_tipe') }}" placeholder="Masukkan model/tipe">
                                    @error('model_tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_seri" class="form-label">No. Seri</label>
                                    <input type="text" class="form-control @error('no_seri') is-invalid @enderror" id="no_seri" name="no_seri" value="{{ old('no_seri') }}" placeholder="Masukkan nomor seri">
                                    @error('no_seri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_order" class="form-label">No. Order</label>
                                    <input type="text" class="form-control @error('no_order') is-invalid @enderror" id="no_order" name="no_order" value="{{ old('no_order') }}" placeholder="Masukkan nomor order">
                                    @error('no_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3"><i class="ri-user-3-line me-2"></i>Informasi Pemilik</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                    <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" placeholder="Masukkan nama pemilik">
                                    @error('nama_pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                                    <input type="text" class="form-control @error('nama_ruang') is-invalid @enderror" id="nama_ruang" name="nama_ruang" value="{{ old('nama_ruang') }}" placeholder="Masukkan nama ruang">
                                    @error('nama_ruang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="alamat_pemilik" class="form-label">Alamat Pemilik</label>
                                    <textarea class="form-control @error('alamat_pemilik') is-invalid @enderror" id="alamat_pemilik" name="alamat_pemilik" rows="3" placeholder="Masukkan alamat pemilik">{{ old('alamat_pemilik') }}</textarea>
                                    @error('alamat_pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3"><i class="ri-map-pin-line me-2"></i>Lokasi & Hasil</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi_kalibrasi" class="form-label">Lokasi Kalibrasi</label>
                                    <input type="text" class="form-control @error('lokasi_kalibrasi') is-invalid @enderror" id="lokasi_kalibrasi" name="lokasi_kalibrasi" value="{{ old('lokasi_kalibrasi') }}" placeholder="Masukkan lokasi kalibrasi">
                                    @error('lokasi_kalibrasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hasil" class="form-label">Hasil Kalibrasi</label>
                                    <textarea class="form-control @error('hasil') is-invalid @enderror" id="hasil" name="hasil" rows="3" placeholder="Masukkan hasil kalibrasi">{{ old('hasil') }}</textarea>
                                    @error('hasil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="metode_kerja" class="form-label">Metode Kerja</label>
                                    <textarea class="form-control @error('metode_kerja') is-invalid @enderror" id="metode_kerja" name="metode_kerja" rows="3" placeholder="Masukkan metode kerja">{{ old('metode_kerja') }}</textarea>
                                    @error('metode_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('kalibrasi.index') }}" class="btn btn-light">
                                        <i class="ri-arrow-left-line me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line me-1"></i> Simpan Data
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
