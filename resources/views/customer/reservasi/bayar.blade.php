@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pembayaran Reservasi</h2>
        <div class="mb-3">
            <p><strong>Nama Kucing:</strong> {{ $reservasi->kucing->nama }}</p>
            <p><strong>Kandang:</strong> {{ $reservasi->kandang->ukuran }}</p>
            <p><strong>Status:</strong> {{ $reservasi->status }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $reservasi->status_pembayaran }}</p>
        </div>
        <form action="{{ route('customer.reservasi.prosesBayar', $reservasi->id_reservasi) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Bayar</button>
            <a href="{{ route('customer.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
