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

            <div class="mt-6 flex gap-4 justify-center md:justify-start">

                <a href="{{ route('adproduct.create', ['after' => $firstCard->id]) }}" 
                   class="bg-blue-600 hover:bg-blue-700 font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                style="color: white !important;">
                    Tambah Card
                </a>

                <a href="{{ route('adproduct.edit', $firstCard->id) }}"
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

                <div class="flex justify-between mt-4 px-2">
                    <a href="{{ route('adproduct.create', ['after' => $card->id]) }}" 
                       class="bg-blue-600 hover:bg-blue-700 font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                style="color: white !important;">
                        Tambah Card
                    </a>

                    <a href="{{ route('adproduct.edit', $card->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 font-semibold px-6 py-3 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50"
                    style="color: white !important;">
                        Edit
                    </a>

                    <form action="{{ route('adproduct.destroy', $card->id) }}" method="POST" 
                          onsubmit="return confirm('Konfirmasi Penghapusan card ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-3 rounded-md shadow hover:bg-red-700 transition duration-300" style="color: white !important;">
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
