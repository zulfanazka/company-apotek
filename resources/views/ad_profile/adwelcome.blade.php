@extends('layouts.main')

@section('content')
@include('layout.header')
<body>
    <div class="container mx-auto py-12 space-y-8">

        @php
            $firstCard = $cards->first();
            $otherCards = $cards->skip(1);
        @endphp

        {{-- Card pertama statis, isi dengan konten About Us dari $firstCard --}}
        <section class="bg-white py-16 px-6 rounded-lg shadow-md" id="card-{{ $firstCard->id }}">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">
                {{-- Text Section --}}
                <div class="md:w-1/2">
                    <h1 class="text-5xl font-bold text-blue-700 leading-tight mb-6">
                        {!! $firstCard->title !!}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        {!! $firstCard->text !!}
                    </p>
                    <a href="{{ route('profiles') }}"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                        About us
                    </a>

                    {{-- Tombol Edit card pertama --}}
                    <div class="mt-6">
                        <a href="{{ route('adwelcome.edit', $firstCard->id) }}"
                            class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                            Edit
                        </a>
                    </div>
                </div>

                {{-- Image Section --}}
                <div class="md:w-1/2">
                    @if ($firstCard->image)
                        <img src="{{ asset($firstCard->image) }}" alt="Card Image" class="rounded-xl shadow-lg w-full object-cover" />
                    @else
                        <img src="img/placeholder.png" alt="Placeholder" class="rounded-xl shadow-lg w-full object-cover" />
                    @endif
                </div>
            </div>
        </section>

        {{-- Loop untuk card lainnya mulai dari index 1 --}}
        @foreach ($otherCards as $index => $card)
            <div id="card-{{ $card->id }}" class="border p-6 rounded-lg shadow-md flex flex-col">

                <x-card-section
                    :layout="$card->layout"
                    textAlign="left"
                    :title="$card->title"
                    :text="$card->text"
                    :image="$card->image ? asset($card->image) : null"
                />

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
                    <form action="{{ route('adwelcome.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus card ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-3 rounded-md shadow hover:bg-red-700 transition duration-300">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        @endforeach

    </div>
</body>
@include('layout.footer')
@endsection
