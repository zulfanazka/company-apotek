@extends('layouts.main')

@section('content')
@include('layout.header')
<body>

    {{-- Card text kiri, gambar kanan --}}
    <x-card-section
        layout="text-left"
        textAlign="left"
        title="Berikan yang<br>Terbaik untuk<br>Kesehatan Anda"
        text="Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik. Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang ramah."
        image="img/klinik.png"
    >
        <a href="{{ route('profiles') }}"
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
            About us
        </a>
    </x-card-section>

    {{-- Card gambar kiri, teks kanan --}}
@extends('layouts.main')

@section('content')
@include('layout.header')
<body>
    <div class="container mx-auto py-12">
        @foreach ($cards as $card)
            <x-card-section
                :layout="$card->layout"
                textAlign="left"
                :title="$card->title"
                :text="$card->text"
                :image="$card->image ? asset('storage/'.$card->image) : null"
            >
                {{-- Tambahkan tombol edit dan hapus di sini --}}
                <a href="{{ route('adwelcome.edit', $card->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('adwelcome.destroy', $card->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                </form>
            </x-card-section>
        @endforeach
    </div>
</body>
@include('layout.footer')
@endsection


</body>
@include('layout.footer')
