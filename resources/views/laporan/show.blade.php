@extends('back.template.index')
@section('title', 'Detail Laporan Kalibrasi')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Detail Laporan Kalibrasi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan Kalibrasi</a></li>
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
                        <i class="ri-file-text-line me-2"></i>Detail Laporan Kalibrasi
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
                                    <h6 class="mb-0 text-primary">{{ $laporan->nama_alat }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Merk</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $laporan->merk }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Nomor Seri</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">{{ $laporan->no_seri }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Teknisi</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-user-line me-1"></i>{{ $laporan->teknisi }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Kalibrasi -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-calendar-line me-2"></i>Jadwal Kalibrasi
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tanggal Kalibrasi</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-calendar-check-line me-1"></i>
                                        {{ \Carbon\Carbon::parse($laporan->tgl_kalibrasi)->format('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tanggal Kalibrasi Berikutnya</label>
                                <div class="p-3 bg-light rounded">
                                    <h6 class="mb-0">
                                        <i class="ri-calendar-todo-line me-1"></i>
                                        {{ \Carbon\Carbon::parse($laporan->tgl_next_kalibrasi)->format('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Perhitungan -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-calculator-line me-2"></i>Hasil Perhitungan
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Nilai Pengukuran</label>
                                <div class="p-3 bg-light rounded">
                                    @php
                                        $sets = $laporan->sets ?? [];
                                    @endphp
                                    @if($sets && count($sets))
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Nilai Setting</th>
                                                        <th>Pengukuran</th>
                                                        <th>Rata-rata</th>
                                                        <th>SD</th>
                                                        <th>Ua</th>
                                                        <th>Koreksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sets as $s)
                                                    @php
                                                        $vals = is_array($s->nilai_pengukuran) ? $s->nilai_pengukuran : ($s->nilai_pengukuran ? json_decode($s->nilai_pengukuran, true) : []);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ number_format($s->nilai_setting, 10) }}</td>
                                                        <td>
                                                            @foreach($vals as $v)
                                                                <span class="badge bg-primary me-1 mb-1">{{ number_format($v, 10) }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $s->rata_rata !== null ? number_format($s->rata_rata, 10) : '-' }}</td>
                                                        <td>{{ $s->standar_deviasi !== null ? number_format($s->standar_deviasi, 10) : '-' }}</td>
                                                        <td>{{ $s->u_a_value !== null ? number_format($s->u_a_value, 10) : '-' }}</td>
                                                        <td>{{ $s->nilai_koreksi !== null ? number_format($s->nilai_koreksi, 10) : '-' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        @php
                                            $pengukuran = is_array($laporan->nilai_pengukuran) ? $laporan->nilai_pengukuran : ($laporan->nilai_pengukuran ? json_decode($laporan->nilai_pengukuran, true) : []);
                                        @endphp
                                        @forelse($pengukuran as $nilai)
                                            <span class="badge bg-primary me-1 mb-1">{{ number_format($nilai, 10) }}</span>
                                        @empty
                                            <span class="text-muted">-</span>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Hasil Kalibrasi -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-file-list-3-line me-2"></i>Hasil Kalibrasi
                            </h5>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0">{{ $laporan->hasil }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- File Laporan -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="ri-attachment-line me-2"></i>File Laporan
                            </h5>
                            @if ($laporan->file_path)
                                <div class="d-flex gap-2">
                                    <a href="{{ asset($laporan->file_path) }}" target="_blank" class="btn btn-primary">
                                        <i class="ri-eye-line me-1"></i> Lihat File
                                    </a>
                                    <a href="{{ route('laporan.download', $laporan->id) }}" class="btn btn-success">
                                        <i class="ri-download-line me-1"></i> Unduh File
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="ri-information-line me-2"></i>
                                    Tidak ada file laporan yang diunggah.
                                </div>
                            @endif
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
                                        {{ $laporan->created_at->format('d F Y, H:i') }}
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
                                        {{ $laporan->updated_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
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
                                <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-primary">
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
