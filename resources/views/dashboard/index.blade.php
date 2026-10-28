@extends('back.template.index')
@section('title' ,'Dashboard')

@push('css')
<style>
  .dashboard-stats .avatar-sm { width: 44px !important; height: 44px !important; }
  .dashboard-stats .avatar-title { width: 44px !important; height: 44px !important; display: flex; align-items: center; justify-content: center; }
  .dashboard-stats .avatar-title i { color: #fff !important; font-size: 24px; line-height: 1; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ringkasan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Stats Cards -->
    <div class="row dashboard-stats">
        <div class="col-xl-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary text-white rounded-2">
                                <i class="ri-user-3-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Pengguna</p>
                            <h4 class="mb-0">{{ $stats['users'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info text-white rounded-2">
                                <i class="ri-install-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Instalasi</p>
                            <h4 class="mb-0">{{ $stats['instalasi'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-success text-white rounded-2">
                                <i class="ri-tools-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Kalibrasi</p>
                            <h4 class="mb-0">{{ $stats['kalibrasi'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-warning text-white rounded-2">
                                <i class="ri-settings-3-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Maintenance</p>
                            <h4 class="mb-0">{{ $stats['maintenance'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="ri-tools-line me-2"></i>Kalibrasi per Bulan</h4>
                </div>
                <div class="card-body">
                    <div id="kalibrasiChart" style="min-height: 320px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="ri-settings-3-line me-2"></i>Maintenance per Bulan</h4>
                </div>
                <div class="card-body">
                    <div id="maintenanceChart" style="min-height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tables -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0"><i class="ri-time-line me-2"></i>Terbaru Kalibrasi</h4>
                        <a href="{{ route('kalibrasi.index') }}" class="btn btn-soft-primary btn-sm">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Alat</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentKalibrasi as $item)
                                    <tr>
                                        <td>{{ $item->nama_alat ?? '-' }}</td>
                                        <td>{{ $item->merk_alat ?? '-' }}</td>
                                        <td>{{ $item->tipe_alat ?? '-' }}</td>
                                        <td>{{ optional($item->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('kalibrasi.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0"><i class="ri-time-line me-2"></i>Terbaru Maintenance</h4>
                        <a href="{{ route('maintenance.index') }}" class="btn btn-soft-primary btn-sm">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Alat</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentMaintenance as $item)
                                    <tr>
                                        <td>{{ $item->nama_alat ?? '-' }}</td>
                                        <td>{{ $item->merk_alat ?? '-' }}</td>
                                        <td>{{ $item->tipe_alat ?? '-' }}</td>
                                        <td>{{ optional($item->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('maintenance.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // ApexCharts options
    const months = @json($months);
    const kalibrasiData = @json($kalibrasiMonthly);
    const maintenanceData = @json($maintenanceMonthly);

    const baseOptions = {
        chart: { type: 'area', height: 320, toolbar: { show: false } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: { categories: months },
        yaxis: { min: 0 },
        colors: ['#3b82f6'],
        grid: { strokeDashArray: 4 },
    };

    const kalibrasiOptions = {
        ...baseOptions,
        series: [{ name: 'Kalibrasi', data: kalibrasiData }],
        colors: ['#10b981']
    };

    const maintenanceOptions = {
        ...baseOptions,
        series: [{ name: 'Maintenance', data: maintenanceData }],
        colors: ['#f59e0b']
    };

    const kalibrasiChart = new ApexCharts(document.querySelector('#kalibrasiChart'), kalibrasiOptions);
    const maintenanceChart = new ApexCharts(document.querySelector('#maintenanceChart'), maintenanceOptions);

    kalibrasiChart.render();
    maintenanceChart.render();
</script>
@endpush