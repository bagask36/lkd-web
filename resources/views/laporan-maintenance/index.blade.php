@extends('back.template.index')
@section('title', 'Laporan Maintenance')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Laporan Maintenance</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Maintenance</li>
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
                            <i class="ri-file-list-3-line me-2"></i>Daftar Laporan Maintenance
                        </h4>
                        <a href="{{ route('laporan-maintenance.create') }}" class="btn btn-primary">
                            <i class="ri-add-line me-1"></i> Tambah Laporan
                        </a>
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

                    <div class="table-responsive">
                        <table id="laporanMaintenanceTable" class="table table-bordered table-striped table-hover">
                            <thead class="table-light align-middle">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Nama Alat</th>
                                    <th width="12%">Merk</th>
                                    <th width="12%">No. Seri</th>
                                    <th width="10%">Tgl. Maintenance</th>
                                    <th width="20%">Tindakan</th>
                                    <th width="15%">Hasil</th>
                                    <th width="10%">Teknisi</th>
                                    <th width="8%">Aksi</th>
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
        $('#laporanMaintenanceTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('laporan-maintenance.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center'},
                {data: 'nama_alat', name: 'nama_alat'},
                {data: 'merk', name: 'merk'},
                {data: 'no_seri', name: 'no_seri', className: 'text-center'},
                {
                    data: 'tgl_maintenance', 
                    name: 'tgl_maintenance', 
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
                {data: 'tindakan', name: 'tindakan'},
                {data: 'hasil', name: 'hasil'},
                {data: 'teknisi', name: 'teknisi'},
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
    });
</script>
@endpush