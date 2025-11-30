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
                                    <select id="selectKalibrasi" class="form-select js-select2-kalibrasi" style="width: 100%"></select>
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

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="ri-calculator-line me-2"></i>Data Pengukuran (Maks. 5 Set)
                                </h5>
                            </div>
                            <div id="sets-container" class="col-12">
                                <div class="card mb-3 set-card" data-index="0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Nilai Setting Alat <span class="text-danger">*</span></label>
                                                    <input type="number" step="any" class="form-control nilai-setting-input" name="nilai_sets[0][setting]" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label">Nilai Hasil Pengukuran <span class="text-danger">*</span></label>
                                                    <div class="pengukuran-list">
                                                        <div class="input-group mb-2">
                                                            <input type="number" step="any" class="form-control nilai-pengukuran-input" name="nilai_sets[0][pengukuran][]" required>
                                                            <button class="btn btn-outline-danger remove-pengukuran" type="button"><i class="ri-delete-bin-line"></i></button>
                                                        </div>
                                                        <div class="input-group mb-2">
                                                            <input type="number" step="any" class="form-control nilai-pengukuran-input" name="nilai_sets[0][pengukuran][]" required>
                                                            <button class="btn btn-outline-danger remove-pengukuran" type="button"><i class="ri-delete-bin-line"></i></button>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-outline-secondary btn-sm add-pengukuran" type="button"><i class="ri-add-line me-1"></i> Tambah Pengukuran</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 set-results d-none">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Rata-rata:</strong> <span class="set-display-rata-rata text-success">...</span></p>
                                                    <p><strong>Standar Deviasi:</strong> <span class="set-display-standar-deviasi text-info">...</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Nilai Koreksi:</strong> <span class="set-display-nilai-koreksi text-warning">...</span></p>
                                                    <p><strong>Ketidakpastian Tipe A (Ua):</strong> <span class="set-display-ua text-danger">...</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-danger btn-sm remove-set" type="button"><i class="ri-close-line me-1"></i> Hapus Set</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button id="add-set" class="btn btn-outline-primary btn-sm" type="button"><i class="ri-add-line me-1"></i> Tambah Set</button>
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
    function addSet(index) {
        const card = document.createElement('div');
        card.className = 'card mb-3 set-card';
        card.dataset.index = index;
        card.innerHTML = `
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nilai Setting Alat <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control nilai-setting-input" name="nilai_sets[${index}][setting]" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Nilai Hasil Pengukuran <span class="text-danger">*</span></label>
                            <div class="pengukuran-list"></div>
                            <button class="btn btn-outline-secondary btn-sm add-pengukuran" type="button"><i class="ri-add-line me-1"></i> Tambah Pengukuran</button>
                        </div>
                    </div>
                </div>
                <div class="mt-2 set-results d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Rata-rata:</strong> <span class="set-display-rata-rata text-success">...</span></p>
                            <p><strong>Standar Deviasi:</strong> <span class="set-display-standar-deviasi text-info">...</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nilai Koreksi:</strong> <span class="set-display-nilai-koreksi text-warning">...</span></p>
                            <p><strong>Ketidakpastian Tipe A (Ua):</strong> <span class="set-display-ua text-danger">...</span></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-danger btn-sm remove-set" type="button"><i class="ri-close-line me-1"></i> Hapus Set</button>
                </div>
            </div>
        `;
        const list = card.querySelector('.pengukuran-list');
        for (let i = 0; i < 2; i++) {
            const group = document.createElement('div');
            group.className = 'input-group mb-2';
            group.innerHTML = `
                <input type="number" step="any" class="form-control nilai-pengukuran-input" name="nilai_sets[${index}][pengukuran][]" required>
                <button class="btn btn-outline-danger remove-pengukuran" type="button"><i class="ri-delete-bin-line"></i></button>
            `;
            list.appendChild(group);
        }
        document.getElementById('sets-container').appendChild(card);
        computeSet(card);
    }

    document.getElementById('add-set').addEventListener('click', function () {
        const container = document.getElementById('sets-container');
        const count = container.querySelectorAll('.set-card').length;
        if (count >= 5) return;
        addSet(count);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.add-pengukuran')) {
            const card = e.target.closest('.set-card');
            const index = card.dataset.index;
            const list = card.querySelector('.pengukuran-list');
            const group = document.createElement('div');
            group.className = 'input-group mb-2';
            group.innerHTML = `
                <input type="number" step="any" class="form-control nilai-pengukuran-input" name="nilai_sets[${index}][pengukuran][]" required>
                <button class="btn btn-outline-danger remove-pengukuran" type="button"><i class="ri-delete-bin-line"></i></button>
            `;
            list.appendChild(group);
            computeSet(card);
        }
        if (e.target.closest('.remove-pengukuran')) {
            const group = e.target.closest('.input-group');
            if (group) group.remove();
            const card = e.target.closest('.set-card');
            computeSet(card);
        }
        if (e.target.closest('.remove-set')) {
            const card = e.target.closest('.set-card');
            card.remove();
            const cards = document.querySelectorAll('.set-card');
            cards.forEach((c, i) => {
                c.dataset.index = i;
                c.querySelector('.nilai-setting-input').setAttribute('name', `nilai_sets[${i}][setting]`);
                c.querySelectorAll('.nilai-pengukuran-input').forEach(inp => {
                    inp.setAttribute('name', `nilai_sets[${i}][pengukuran][]`);
                });
            });
        }
    });

    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('nilai-setting-input') || e.target.classList.contains('nilai-pengukuran-input')) {
            const card = e.target.closest('.set-card');
            computeSet(card);
        }
    });

    function computeSet(card) {
        if (!card) return;
        const settingInput = card.querySelector('.nilai-setting-input');
        const measureInputs = Array.from(card.querySelectorAll('.nilai-pengukuran-input'));
        const setting = parseFloat(settingInput.value);
        const measures = measureInputs.map(inp => parseFloat(inp.value)).filter(v => !isNaN(v));
        const resultsBox = card.querySelector('.set-results');
        const hasAnyInput = (settingInput.value && settingInput.value !== '') || measureInputs.some(inp => inp.value && inp.value !== '');
        if (resultsBox) {
            if (hasAnyInput) {
                resultsBox.classList.remove('d-none');
            } else {
                resultsBox.classList.add('d-none');
            }
        }
        const rataEl = card.querySelector('.set-display-rata-rata');
        const sdEl = card.querySelector('.set-display-standar-deviasi');
        const koreksiEl = card.querySelector('.set-display-nilai-koreksi');
        const uaEl = card.querySelector('.set-display-ua');
        if (isNaN(setting) || measures.length < 2 || measures.length !== measureInputs.length) {
            rataEl.textContent = '...';
            sdEl.textContent = '...';
            koreksiEl.textContent = '...';
            uaEl.textContent = '...';
            return;
        }
        const n = measures.length;
        const mean = measures.reduce((sum, v) => sum + v, 0) / n;
        let sumSq = 0;
        for (let i = 0; i < n; i++) sumSq += Math.pow(measures[i] - mean, 2);
        const sd = Math.sqrt(sumSq / (n - 1));
        const ua = sd / Math.sqrt(n);
        const koreksi = mean - setting;
        rataEl.textContent = mean.toFixed(10);
        sdEl.textContent = sd.toFixed(10);
        koreksiEl.textContent = koreksi.toFixed(10);
        uaEl.textContent = ua.toFixed(10);
    }

    document.querySelectorAll('.set-card').forEach(card => computeSet(card));

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
        $('.js-select2-kalibrasi').select2({
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

        $('.js-select2-kalibrasi').on('select2:select', function (e) {
            const data = e.params.data;
            $('#kalibrasi_id').val(data.id);
            if (data.nama_alat) $('#nama_alat').val(data.nama_alat);
            if (data.merk_alat) $('#merk').val(data.merk_alat);
            if (data.no_seri) $('#no_seri').val(data.no_seri);
        });

        $('.js-select2-kalibrasi').on('select2:clear', function () {
            $('#kalibrasi_id').val('');
        });
    });
</script>
@endpush
