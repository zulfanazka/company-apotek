@extends('layouts.main')

@section('content')
    <style>
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 0px 20px;
        }

        .breadcrumb a {
            text-decoration: none;
        }
    </style>

    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('barangmasuk') }}" class="fw-bold text-dark">Barang Masuk</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">
                    <strong>{{ isset($barang) ? 'Edit Barang' : 'Tambah Barang' }}</strong>
                </li>
            </ol>
        </nav>

        <p class="text-muted">*Semua field wajib diisi kecuali ada keterangan</p>

        <form action="{{ route('simpanbarang') }}" method="POST">
            @csrf
            @if (isset($barang))
                <input type="hidden" name="edit" value="{{ $barang->id_barang }}">
            @endif

            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option hidden>- Pilih Kategori -</option>
                        @foreach (['Obat', 'Vitamin', 'Antibiotik'] as $kategori)
                            <option value="{{ $kategori }}"
                                {{ old('kategori', $barang->kategori ?? '') === $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $barang->tanggal_masuk ?? now()->format('Y-m-d')) }}" required>
                    @error('tanggal_masuk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
                    @error('nama_barang')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="id_barang" class="form-label">ID Barang</label>
                    <input type="text" class="form-control" name="id_barang"
                        value="{{ old('id_barang', $barang->id_barang ?? '') }}" required
                        {{ isset($barang) ? 'readonly' : '' }}>
                    @error('id_barang')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" name="stok"
                        value="{{ old('stok', $barang->stok ?? '') }}" required>
                    @error('stok')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control" name="satuan"
                        value="{{ old('satuan', $barang->satuan ?? '') }}" required>
                    @error('satuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" class="form-control" name="harga_beli"
                        value="{{ old('harga_beli', $barang->harga_beli ?? '') }}" required>
                    @error('harga_beli')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" class="form-control" name="harga_jual"
                        value="{{ old('harga_jual', $barang->harga_jual ?? '') }}" required>
                    @error('harga_jual')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- <div class="col-md-6 mb-3">
                    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar"
                        value="{{ old('tanggal_keluar', $barang->tanggal_keluar ?? '') }}">
                    @error('tanggal_keluar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}

                {{-- <div class="col-md-6 mb-3">
                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                    <input type="number" class="form-control" name="jumlah_keluar"
                        value="{{ old('jumlah_keluar', $barang->jumlah_keluar ?? 0) }}">
                    @error('jumlah_keluar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}
            </div>

            {{-- <div class="mb-3">
                <label for="detail_obat" class="form-label">Detail Obat</label>
                <textarea class="form-control" name="detail_obat" rows="3">{{ old('detail_obat', $barang->detail_obat ?? '') }}</textarea>
                @error('detail_obat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}

            <div class="mb-4">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $barang->keterangan ?? '') }}</textarea>
                @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('barangmasuk') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Barang</button>
            </div>
        </form>
    </div>
@endsection
