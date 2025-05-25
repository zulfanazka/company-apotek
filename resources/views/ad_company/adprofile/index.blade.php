@extends('layouts.main')

@section('content')
@include('layout.header')

<body>
    <div class="container mx-auto py-12 space-y-8">

        @php
            $firstCard = $cards->first();
            $otherCards = $cards->skip(1);
        @endphp

        @if ($firstCard)
        <section id="card-{{ $firstCard->id }}" class="py-16 px-6 rounded-lg">
            <x-card-section
                :layout="$firstCard->layout"
                :textAlign="$firstCard->text_align ?? 'left'"
                :title="$firstCard->title"
                :text="$firstCard->text"
                :image="$firstCard->image ? asset('storage/' . $firstCard->image) : null"
                :fitMode="$firstCard->fit_mode ?? 'cover'"
            />

            <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="{{ route('adprofile.create', ['after' => $firstCard->id]) }}" 
                   class="bg-blue-600 hover:bg-blue-700 font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                style="color: white !important;">
                    Tambah Card
                </a>

                <a href="{{ route('adprofile.edit', $firstCard->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                    style="color: white !important;">
                    Edit
                </a>
                
            </div>
        </section>
        @endif

        @foreach ($otherCards as $card)
            <div id="card-{{ $card->id }}" class="border p-6 rounded-lg shadow-md flex flex-col space-y-4">

                <x-card-section
                    :layout="$card->layout"
                    :textAlign="$card->text_align ?? 'left'"
                    :title="$card->title"
                    :text="$card->text"
                    :image="$card->image ? asset('storage/' . $card->image) : null"
                    :fitMode="$card->fit_mode ?? 'contain'"
                />

                <div class="flex flex-wrap gap-4 mt-4 px-2 justify-center md:justify-between">
                    <a href="{{ route('adprofile.create', ['after' => $card->id]) }}" 
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Tambah Card
                    </a>

                    <a href="{{ route('adprofile.edit', $card->id) }}"
                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                        Edit
                    </a>

                    <form action="{{ route('adprofile.destroy', $card->id) }}" method="POST" 
                          onsubmit="return confirm('Konfirmasi Penghapusan card ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
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
