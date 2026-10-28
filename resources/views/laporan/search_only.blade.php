@extends('back.template.index')

@section('title', 'Cari Laporan Kalibrasi')

@section('content')
<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header">
            <h4>Pencarian Laporan Kalibrasi</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Gunakan formulir di bawah ini untuk mencari laporan berdasarkan nama alat, merek, atau teknisi.</p>
            <form action="{{ route('laporan.search_results') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama alat, merek, atau teknisi..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    @if(request('search'))
                    <a href="{{ route('laporan.search_only') }}" class="btn btn-outline-danger">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(isset($laporan) && $laporan->count() > 0)
        <div class="d-none d-md-block">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Merk</th>
                            <th>No. Seri</th>
                            <th>Tgl. Kalibrasi</th>
                            <th>Teknisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_alat }}</td>
                            <td>{{ $item->merk }}</td>
                            <td>{{ $item->no_seri }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kalibrasi)->format('d-m-Y') }}</td>
                            <td>{{ $item->teknisi }}</td>
                            <td>
                                <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-md-none">
            @foreach ($laporan as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_alat }}</h5>
                    <p class="card-text mb-1"><strong>Merk:</strong> {{ $item->merk }}</p>
                    <p class="card-text mb-1"><strong>No. Seri:</strong> {{ $item->no_seri }}</p>
                    <p class="card-text mb-1"><strong>Tgl. Kalibrasi:</strong> {{ \Carbon\Carbon::parse($item->tgl_kalibrasi)->format('d-m-Y') }}</p>
                    <p class="card-text mb-1"><strong>Teknisi:</strong> {{ $item->teknisi }}</p>
                    <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-info btn-sm mt-2">
                        <i class="fa fa-eye"></i> Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    @elseif(isset($laporan) && $laporan->count() == 0)
        <div class="alert alert-warning">
            Tidak ditemukan laporan yang cocok.
        </div>
    @endif
</div>
@endsection