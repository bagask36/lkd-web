@extends('back.template.index')

@section('title', 'Daftar Laporan Kalibrasi')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Laporan Kalibrasi</h2>
        <a href="{{ route('laporan.create') }}" class="btn btn-primary">Tambah Laporan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="laporanTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Merk</th>
                        <th>No. Seri</th>
                        <th>Tgl. Kalibrasi</th>
                        <th>Tgl. Next Kalibrasi</th>
                        <th>Hasil</th>
                        <th>Teknisi</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('script')
<!-- jQuery HARUS di atas DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laporanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('laporan.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_alat', name: 'nama_alat'},
                {data: 'merk', name: 'merk'},
                {data: 'no_seri', name: 'no_seri'},
                {data: 'tgl_kalibrasi', name: 'tgl_kalibrasi'},
                {data: 'tgl_next_kalibrasi', name: 'tgl_next_kalibrasi'},
                {data: 'hasil', name: 'hasil'},
                {data: 'teknisi', name: 'teknisi'},
                {data: 'file_download', name: 'file_download', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            }
        });
    });
</script>
@endpush
@endsection