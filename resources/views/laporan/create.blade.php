@extends('back.template.index')
@section('title', 'Tambah Laporan Kalibrasi')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tambah Laporan Kalibrasi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan Kalibrasi</a></li>
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
                        <i class="ri-file-text-line me-2"></i>Form Tambah Laporan Kalibrasi
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

                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Informasi Alat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-tools-line me-2"></i>Informasi Alat
                                </h5>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="selectKalibrasi" class="form-label">Pilih Kalibrasi (Nama • Merk • No. Seri)</label>
                                    <select id="selectKalibrasi" class="form-select" style="width: 100%"></select>
                                    <input type="hidden" id="kalibrasi_id" name="kalibrasi_id" value="{{ old('kalibrasi_id') }}">
                                </div>
                            </div>
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
                                    <label for="merk" class="form-label">
                                        Merk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror" 
                                           id="merk" name="merk" 
                                           value="{{ old('merk') }}" 
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
                                           value="{{ old('no_seri') }}" 
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
                                           value="{{ old('teknisi') }}" 
                                           placeholder="Masukkan nama teknisi" required>
                                    @error('teknisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Kalibrasi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-calendar-line me-2"></i>Jadwal Kalibrasi
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_kalibrasi" class="form-label">
                                        Tanggal Kalibrasi <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('tgl_kalibrasi') is-invalid @enderror" 
                                           id="tgl_kalibrasi" name="tgl_kalibrasi" 
                                           value="{{ old('tgl_kalibrasi') }}" required>
                                    @error('tgl_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_next_kalibrasi" class="form-label">
                                        Tanggal Kalibrasi Berikutnya <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('tgl_next_kalibrasi') is-invalid @enderror" 
                                           id="tgl_next_kalibrasi" name="tgl_next_kalibrasi" 
                                           value="{{ old('tgl_next_kalibrasi') }}" required>
                                    @error('tgl_next_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hasil Kalibrasi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-file-list-3-line me-2"></i>Hasil Kalibrasi
                                </h5>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="hasil" class="form-label">
                                        Hasil <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('hasil') is-invalid @enderror" 
                                              id="hasil" name="hasil" rows="3" 
                                              placeholder="Masukkan hasil kalibrasi" required>{{ old('hasil') }}</textarea>
                                    @error('hasil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Pengukuran -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-calculator-line me-2"></i>Data Pengukuran
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nilai_setting" class="form-label">
                                        Nilai Setting Alat <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="any" class="form-control @error('nilai_setting') is-invalid @enderror" 
                                           id="nilai_setting" name="nilai_setting" 
                                           value="{{ old('nilai_setting') }}" 
                                           placeholder="Masukkan nilai setting alat" required>
                                    @error('nilai_setting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Nilai Hasil Pengukuran <span class="text-danger">*</span>
                                        <small class="text-muted">(Ulangi beberapa kali)</small>
                                    </label>
                                    <div id="pengukuran-container">
                                        <div class="input-group mb-2">
                                            <input type="number" step="any" class="form-control nilai-pengukuran @error('nilai_pengukuran') is-invalid @enderror" 
                                                   name="nilai_pengukuran[]" placeholder="Masukkan nilai pengukuran" required>
                                            <button class="btn btn-outline-danger remove-pengukuran" type="button">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button id="add-pengukuran" class="btn btn-outline-secondary btn-sm" type="button">
                                        <i class="ri-add-line me-1"></i> Tambah Pengukuran
                                    </button>
                                    @error('nilai_pengukuran')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hasil Perhitungan Live -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            <i class="ri-calculator-line me-2"></i>Hasil Perhitungan Live
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Rata-rata:</strong> <span id="display-rata-rata" class="text-success">...</span></p>
                                                <p><strong>Standar Deviasi:</strong> <span id="display-standar-deviasi" class="text-info">...</span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Nilai Koreksi:</strong> <span id="display-nilai-koreksi" class="text-warning">...</span></p>
                                                <p><strong>Ketidakpastian Tipe A (Ua):</strong> <span id="display-ua" class="text-danger">...</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Laporan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-attachment-line me-2"></i>File Laporan
                                </h5>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="file_kalibrasi" class="form-label">
                                        Unggah Laporan <small class="text-muted">(.jpg, .png, .pdf)</small>
                                    </label>
                                    <input class="form-control @error('file_kalibrasi') is-invalid @enderror" 
                                           type="file" id="file_kalibrasi" name="file_kalibrasi" 
                                           accept=".jpg,.jpeg,.png,.pdf">
                                    @error('file_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('laporan.index') }}" class="btn btn-light">
                                        <i class="ri-arrow-left-line me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line me-1"></i> Simpan Laporan
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
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function calculateAndDisplay() {
        const nilaiSettingInput = document.getElementById('nilai_setting');
        const pengukuranInputs = document.querySelectorAll('.nilai-pengukuran');
        
        const nilaiSetting = parseFloat(nilaiSettingInput.value);
        const nilaiPengukuran = Array.from(pengukuranInputs).map(input => parseFloat(input.value));
        
        const rataRataDisplay = document.getElementById('display-rata-rata');
        const standarDeviasiDisplay = document.getElementById('display-standar-deviasi');
        const nilaiKoreksiDisplay = document.getElementById('display-nilai-koreksi');
        const uaDisplay = document.getElementById('display-ua');

        // Cek jika ada input yang tidak valid atau kurang dari 2 pengukuran
        if (isNaN(nilaiSetting) || nilaiPengukuran.some(isNaN) || nilaiPengukuran.length < 2) {
            rataRataDisplay.innerText = '...';
            standarDeviasiDisplay.innerText = '...';
            nilaiKoreksiDisplay.innerText = '...';
            uaDisplay.innerText = '...';
            return;
        }

        // Hitung Rata-rata
        const n = nilaiPengukuran.length;
        const rataRata = nilaiPengukuran.reduce((sum, current) => sum + current, 0) / n;
        
        // Hitung Standar Deviasi
        let jumlahKuadratSelisih = 0;
        for (let i = 0; i < n; i++) {
            jumlahKuadratSelisih += Math.pow(nilaiPengukuran[i] - rataRata, 2);
        }
        const standarDeviasi = Math.sqrt(jumlahKuadratSelisih / (n - 1));

        // Hitung Ketidakpastian Tipe A (Ua)
        const uaValue = standarDeviasi / Math.sqrt(n);

        // Hitung Nilai Koreksi
        const nilaiKoreksi = rataRata - nilaiSetting;

        // Tampilkan hasil dengan 10 angka di belakang koma
        rataRataDisplay.innerText = rataRata.toFixed(10);
        standarDeviasiDisplay.innerText = standarDeviasi.toFixed(10);
        nilaiKoreksiDisplay.innerText = nilaiKoreksi.toFixed(10);
        uaDisplay.innerText = uaValue.toFixed(10);
    }

    // Tambah event listener untuk setiap input
    document.getElementById('nilai_setting').addEventListener('input', calculateAndDisplay);
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('nilai-pengukuran')) {
            calculateAndDisplay();
        }
    });

    // Tambah field pengukuran baru
    document.getElementById('add-pengukuran').addEventListener('click', function () {
        const container = document.getElementById('pengukuran-container');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="number" step="any" class="form-control nilai-pengukuran" name="nilai_pengukuran[]" placeholder="Masukkan nilai pengukuran" required>
            <button class="btn btn-outline-danger remove-pengukuran" type="button">
                <i class="ri-delete-bin-line"></i>
            </button>
        `;
        container.appendChild(inputGroup);
        calculateAndDisplay();
    });

    // Hapus field pengukuran
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-pengukuran')) {
            const inputGroups = document.querySelectorAll('#pengukuran-container .input-group');
            if (inputGroups.length > 1) {
                e.target.closest('.input-group').remove();
                calculateAndDisplay();
            } else {
                alert('Minimal harus ada dua field pengukuran untuk perhitungan.');
            }
        }
    });

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

    $(function() {
        $('#selectKalibrasi').select2({
            placeholder: 'Cari dan pilih kalibrasi...',
            allowClear: true,
            ajax: {
                url: "{{ route('kalibrasi.search') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return { results: data };
                },
                cache: true
            },
            minimumInputLength: 1,
            width: '100%'
        });

        $('#selectKalibrasi').on('select2:select', function (e) {
            const data = e.params.data;
            $('#kalibrasi_id').val(data.id);
            if (data.nama_alat) $('#nama_alat').val(data.nama_alat);
            if (data.merk_alat) $('#merk').val(data.merk_alat);
            if (data.no_seri) $('#no_seri').val(data.no_seri);
        });

        $('#selectKalibrasi').on('select2:clear', function () {
            $('#kalibrasi_id').val('');
        });
    });
</script>
@endpush
