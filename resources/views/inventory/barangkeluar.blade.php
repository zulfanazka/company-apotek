@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4 mb-4">Barang Keluar</h1>

            <!-- Filter dan Tombol -->
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <!-- Filter Kategori -->
                    <div>
                        <label>
                            Kategori:
                            <select id="kategoriFilter" class="form-control">
                                <option value="">Semua</option>
                                <option value="Obat">Obat</option>
                                <option value="Vitamin">Vitamin</option>
                                <option value="Antibiotik">Antibiotik</option>
                            </select>
                        </label>
                    </div>

                    <!-- Tombol Tambah dan Cetak -->
                    <div>
                        <a href="{{ route('tambahbarangkeluar') }}" class="btn btn-success">Tambah Barang Keluar</a>
                        <button type="button" class="btn btn-danger mx-2">Cetak</button>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="col-md-12 mt-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Detail</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangKeluar as $item)
                                        <tr>
                                            <td>{{ $item->id_barang }}</td>
                                            <td>{{ $item->inventory->nama_barang ?? '-' }}</td>
                                            <td>{{ $item->inventory->kategori ?? '-' }}</td>
                                            <td>{{ $item->inventory->satuan ?? '-' }}</td>
                                            <td>{{ $item->inventory->tanggal_masuk ?? '-' }}</td>
                                            <td>{{ $item->tanggal_keluar }}</td>
                                            <td>{{ number_format($item->inventory->harga_beli ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ number_format($item->inventory->harga_jual ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ $item->inventory->stok ?? 0 }}</td>
                                            <td>{{ $item->jumlah_keluar }}</td>
                                            <td>{{ $item->detail_obat }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('editbarangkeluar', ['id_barang' => $item->id_barang]) }}"
                                                    class="btn btn-sm btn-success">Edit</a>
                                                <button class="btn btn-sm btn-danger delete-btn"
                                                    data-id="{{ $item->id_barang }}" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $item->id_barang }}">
                                                    Hapus
                                                </button>

                                                <!-- Modal Konfirmasi -->
                                                <div class="modal fade" id="deleteModal-{{ $item->id_barang }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Hapus Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah kamu yakin ingin menghapus barang keluar ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('deletebarangkeluar', ['id_barang' => $item->id_barang]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('table').addEventListener('click', function(e) {
                if (e.target && e.target.matches('.delete-btn')) {
                    const id = e.target.getAttribute('data-id');
                    $('#deleteModal-' + id).modal('show');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            $('#kategoriFilter').on('change', function() {
                var val = $(this).val();
                table.column(2).search(val).draw(); // kolom kategori
            });
        });
    </script>
@endsection
