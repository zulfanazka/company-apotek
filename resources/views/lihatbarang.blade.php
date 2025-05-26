@include('layout.header')

{{-- DataTables CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />

<style>
    /* Container utama agar responsif dan bersih */
    .table-container {
        max-width: 900px;
        margin: 4rem auto;
        padding: 1.5rem 2rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: transparent !important;
        border-radius: 10px;
    }

    /* Judul halaman */
    h1 {
        text-align: center;
        color: #2563eb; /* Tailwind blue-600 */
        margin-bottom: 2.5rem;
        font-weight: 700;
        font-size: 2.8rem;
        letter-spacing: 0.03em;
    }

    /* Styling tabel */
    table.dataTable {
        width: 100% !important;
        border-collapse: separate;
        border-spacing: 0 8px; /* Memberi jarak antar baris */
        font-size: 15px;
        background-color: #fff !important;
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    /* Header tabel */
    thead th {
        background-color: #e0e7ff !important; /* warna biru muda */
        color: #1e293b !important; /* warna teks gelap */
        font-weight: 700;
        text-align: center;
        padding: 12px 15px;
        border-bottom: none !important; /* hilangkan border bawah */
        user-select: none;
    }

    /* Sel body tabel */
    tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border: none !important;
        background-color: #fafafa;
        color: #334155; /* teks abu gelap */
        transition: background-color 0.2s ease;
    }

    /* Hover baris */
    tbody tr:hover td {
        background-color: #f3f4f6 !important; /* abu muda saat hover */
    }

    /* Text alignment spesifik kolom */
    th:nth-child(1), td:nth-child(1),
    th:nth-child(2), td:nth-child(2),
    th:nth-child(5), td:nth-child(5) {
        text-align: left;
        padding-left: 20px;
    }

    th:nth-child(3), td:nth-child(3),
    th:nth-child(4), td:nth-child(4) {
        text-align: left;
        white-space: nowrap;
        padding-right: 20px;
    }

    /* Lebar kolom */
    th:nth-child(1), td:nth-child(1) { min-width: 220px; }
    th:nth-child(2), td:nth-child(2) { min-width: 150px; }
    th:nth-child(3), td:nth-child(3) { width: 80px; }
    th:nth-child(4), td:nth-child(4) { width: 130px; }
    th:nth-child(5), td:nth-child(5) { min-width: 90px; }

    /* Responsive kecil */
    @media (max-width: 640px) {
        h1 { font-size: 1.9rem; margin-bottom: 2rem; }
        table.dataTable thead th, table.dataTable tbody td {
            padding: 10px 12px;
            font-size: 13px;
        }
    }

    /* Pindahkan search box ke kiri */
    div.dataTables_wrapper div.dataTables_filter {
        float: left !important;
        text-align: left !important;
        margin-bottom: 1rem;
    }
</style>

<div class="table-container">
    <h1>Daftar Barang Apotek {{ $lokasi->name ?? '' }}</h1>

    <table id="barangTable" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga (Rp)</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $item)
                <tr>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $item->satuan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6">Data barang belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- JQuery dan DataTables JS --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        $('#barangTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: false,
            pageLength: 10,
            language: {
                search: "Cari:",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ ",
                infoEmpty: "Menampilkan 0 - 0 dari 0 ",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
            }
        });
    });
</script>

@include('layout.footer')
