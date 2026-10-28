@extends('back.template.index')
@section('title', 'Detail Data maintenance')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Data maintenance</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Alat: {{ $maintenance->nama_alat }}</h5>
            <p class="card-text"><strong>Merk Alat:</strong> {{ $maintenance->merk_alat }}</p>
            <p class="card-text"><strong>Tipe Alat:</strong> {{ $maintenance->tipe_alat }}</p>
            <p class="card-text"><strong>Tanggal maintenance:</strong> {{ $maintenance->tanggal_kalibrasi }}</p>
        </div>
    </div>
    <a href="{{ route('maintenance.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection