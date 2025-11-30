@extends('back.template.index')
@section('title', 'Data Kalibrasi')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Kalibrasi</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kalibrasi</li>
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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">
                            <i class="ri-tools-line me-2"></i>Daftar Data Kalibrasi
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('kalibrasi.create') }}" class="btn btn-primary">
                                <i class="ri-add-line me-1"></i> Tambah Data
                            </a>
                            <button id="downloadCsv" type="button" class="btn btn-success">
                                <i class="ri-file-download-line me-1"></i> Unduh CSV
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="ri-check-line me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ri-error-warning-line me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Nama Alat</label>
                                <input type="text" id="filterNamaAlat" class="form-control" placeholder="Cari nama alat">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Merk Alat</label>
                                <input type="text" id="filterMerkAlat" class="form-control" placeholder="Cari merk">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tipe Alat</label>
                                <input type="text" id="filterTipeAlat" class="form-control" placeholder="Cari tipe">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Rentang Tanggal</label>
                                <div class="d-flex gap-2">
                                    <input type="date" id="filterStart" class="form-control">
                                    <input type="date" id="filterEnd" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-2 mt-2">
                                    <button id="applyFilter" type="button" class="btn btn-soft-primary">
                                        <i class="ri-filter-3-line me-1"></i> Terapkan Filter
                                    </button>
                                    <button id="resetFilter" type="button" class="btn btn-light">
                                        <i class="ri-refresh-line me-1"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kalibrasiTable" class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Alat</th>
                                    <th width="20%">Merk Alat</th>
                                    <th width="20%">Tipe Alat</th>
                                    <th width="15%">Tanggal Kalibrasi</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function() {
        const table = $('#kalibrasiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('kalibrasi.index') }}",
                data: function(d) {
                    d.nama_alat = $('#filterNamaAlat').val();
                    d.merk_alat = $('#filterMerkAlat').val();
                    d.tipe_alat = $('#filterTipeAlat').val();
                    d.start_date = $('#filterStart').val();
                    d.end_date = $('#filterEnd').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center'},
                {data: 'nama_alat', name: 'nama_alat'},
                {data: 'merk_alat', name: 'merk_alat'},
                {data: 'tipe_alat', name: 'tipe_alat'},
                {
                    data: 'tanggal_kalibrasi', 
                    name: 'tanggal_kalibrasi', 
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (data) {
                            var date = new Date(data);
                            var day = String(date.getDate()).padStart(2, '0');
                            var month = String(date.getMonth() + 1).padStart(2, '0');
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                        return '';
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            },
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function() {
                // Add custom styling to action buttons
                $('.btn-sm').addClass('me-1 mb-1');
            }
        });

        $('#applyFilter').on('click', function() {
            table.draw();
        });

        $('#resetFilter').on('click', function() {
            $('#filterNamaAlat').val('');
            $('#filterMerkAlat').val('');
            $('#filterTipeAlat').val('');
            $('#filterStart').val('');
            $('#filterEnd').val('');
            table.draw();
        });

        $('#downloadCsv').on('click', function() {
            const params = new URLSearchParams({
                nama_alat: $('#filterNamaAlat').val() || '',
                merk_alat: $('#filterMerkAlat').val() || '',
                tipe_alat: $('#filterTipeAlat').val() || '',
                start_date: $('#filterStart').val() || '',
                end_date: $('#filterEnd').val() || ''
            });
            window.location.href = `{{ route('kalibrasi.export') }}?${params.toString()}`;
        });
    });
</script>
@endpush
