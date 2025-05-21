@extends('layouts.main')

@section('content')
@include('layout.header')
<body>
    <div class="container mx-auto py-12 space-y-8">

        @foreach ($cards as $index => $card)
            <div id="card-{{ $card->id }}" class="border p-6 rounded-lg shadow-md flex flex-col">

                <x-card-section
                    :layout="$card->layout"
                    textAlign="left"
                    :title="$card->title"
                    :text="$card->text"
                    :image="$card->image ? asset($card->image) : null"
                />

                {{-- Container tombol aksi --}}
                <div class="flex justify-between mt-4 px-2">

    {{-- Tombol Tambah --}}
    <a href="{{ route('adwelcome.create') }}"
       class="inline-block bg-green-600 text-white px-6 py-3 rounded-md shadow hover:bg-green-700 transition duration-300">
        Tambah
    </a>

    {{-- Tombol Edit --}}
    <a href="{{ route('adwelcome.edit', $card->id) }}"
       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
        Edit
    </a>

    {{-- Tombol Hapus --}}
    @if($index !== 0)
        <form action="{{ route('adwelcome.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus card ini?')" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-600 text-white px-6 py-3 rounded-md shadow hover:bg-red-700 transition duration-300">
                Hapus
            </button>
        </form>
    @endif

</div>

            </div>
        @endforeach

    </div>
</body>
@include('layout.footer')
@endsection
